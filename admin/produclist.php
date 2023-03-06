
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
	elseif(isset($_POST['inexcel']))
	{
		$in_excel = $_POST['inexcel'];
		// echo '<script>alert("1")</script>';
		$in_file_excel = $pd->in_file_excel();
	}
	else
	{
		
	}
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 25px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }

					 #example th{
						padding-right: 25px;
						
					 }

					 .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  border-radius: 15px;
  margin-bottom: 20px;
  margin-left: 1100px;
}
</style>







<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Sản Phẩm Đang Bán</h2></center>
        <div class="block"> 
        	<?php
        		if(isset($delpd)){
        			echo $delpd;
        		}

        	?>
			<form method = "POST">
        	<button class="button" name="inexcel" id="in_excel_btn">In Danh Sách</button>
			</form>
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng Đang Bán</th>
					<th>Loại Sản Phẩm</th>
					<th>Mô Tả</th>
					<th>Danh Mục</th>
					<th>Đơn Giá</th>
					<th>Ảnh</th>
					<th>Ngày Xuất Kho</th>
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
					<td><?php echo $result['productName']?></td>
					<td><center><?php echo $result['solg_from_storage']?></center></td>
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
					<td><?php echo $fm->format_currency($result['price'])?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="100"></td>
					<td><?php echo $result['export_date'] ?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Sửa</a> || <a href="?productId=<?php echo $result['productId'] ?>">Xóa</a></td>					
					
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- <script>
	$(document).ready(function () {
		var csvFormattedDataTable = '';
		csvFormattedDataTable += "\uFEFF";
		csvFormattedDataTable += "other stuff";
		var encodedUri = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csvFormattedDataTable);
		$('#in_excel_btn').attr("href", encodedUri);
		$('#in_excel_btn').attr("download", 'table-data.csv');
		$('#in_excel_btn').attr("target", '_blank');
	});
</script> -->

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>

