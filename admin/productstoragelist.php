<?php include "inc/header.php";?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/storage.php"; ?>
<?php include_once "../helper/format.php"; ?>

<?php
	$fm = new Format();
	$storage = new storage();
	if(isset($_GET['productId'])){

    $Id = $_GET['productId'];
    $delpd = $pd->del_product($Id);
    }
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 76px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
</style>







<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Sản Phẩm Trong Kho</h2></center>
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
                    <th>Tên Sản Phẩm</th>
                    <th>Loại Sản Phẩm</th>
                    <th>Nhà Phân Phối</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Nhập</th>
					<th>Ảnh Sản Phẩm</th>
                    <th>Ngày Nhập Kho</th>
					<th>Cập Nhật</th>
				</tr>
			</thead>

			<tbody>
				<?php
				
				$pd_storage_list = $storage->show_storage();
				if($pd_storage_list){
					$i = 0;
					while($result = $pd_storage_list->fetch_assoc()){
						$i++;
				?>
				<tr class="oddgradeX">
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['catId']?></td>
                    <td><?php echo $result['supplier']?></td>
                    <td><?php echo $result['quantity']?></td>
                    <td><?php echo $fm->format_currency($result['import_price'])." "."VNĐ"?></td>
                    <td><img src ="uploads/<?php echo $result['image'] ?>" width="100"></td>
                    <td><?php echo $result['import_date']?></td>
					<td><a href="productedit.php?productId=<?php echo $result['Idproduct'] ?>">Sửa</a> || <a href="?productId=<?php echo $result['Idproduct'] ?>">Xóa</a></td>					
					
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



