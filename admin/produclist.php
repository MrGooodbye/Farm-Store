<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include_once "../helper/format.php"; ?>
<?php
	$fm = new Format();
	$pd = new product();
	if(isset($_GET['productId'])){

    $Id = $_GET['productId'];
    $delpd = $pd->del_product($Id);
    }
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 91px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
</style>







<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Sản Phẩm</h2></center>
        <div class="block"> 
        	<?php
        		if(isset($delpd)){
        			echo $delpd;
        		}

        	?>
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<th>Thứ Tự</th>
					<th>Tên Sản Phẩm</th>
					<th>Loại Sản Phẩm</th>
					<th>Mô Tả Sản Phẩm</th>
					<th>Danh Mục</th>
					<th>Giá Bán</th>
					<th>Ảnh Sản Phẩm</th>
					<th>Cập Nhật</th>
				</tr>
			</thead>

			<tbody>
				<?php
				
				$pdlist = $pd->show_product();
				if($pdlist){
					$i = 0;
					while($result = $pdlist->fetch_assoc()){
						$i++;
				?>
				<tr class="oddgradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['catName']?></td>
					<td><?php 

					echo $fm->textShorten($result['product_desc'], 21);

					?></td>
					
					<td>
						<?php
							if($result['type']==1){
								echo 'Đặc Trưng';
							}else{
								echo 'Không Đặc Trưng';
							}
						?>
					</td>
					<td><?php echo $result['price']?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="100"></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Sửa</a>  <a href="?productId=<?php echo $result['productId'] ?>">Xóa</a></td>					
					
				</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>

