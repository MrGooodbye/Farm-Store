<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/cart.php"; ?>
<?php include "../classes/thongke.php"; ?>
<?php include_once "../helper/format.php"; ?>



<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 10px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
                   th {padding-right: 23px;}
</style>


<?php
$ct = new cart();
$thongke = new thongke();
$fm = new Format();

if (isset($_GET['idDatHangXacNhan']))
{
	$id = $_GET['idDatHangXacNhan'];
	$id_cart_offline = $_GET['idDatHangXacNhan'];
	$xacnhandon = $ct->confirm_cart($id);
	$tienhanh_thongke = $thongke->luu_thongke_offline($id_cart_offline);
}
elseif(isset($_GET['idDatHangGiaoHang']))
{
	$id_giao = $_GET['idDatHangGiaoHang'];
	$dongiaohang = $ct->giaohang($id_giao);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Đặt Hàng</h2></center>
        <div class="block"> 
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<th hidden>Mã Đặt</th>
					<th>Tên Khách Hàng</th>
					<th>SĐT</th>
					<th>Địa Chỉ Giao</th>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Tiền</th>
					<th>Hình Ảnh</th>
					<th>Thời Gian Đặt</th>
					<th>Trạng Thái</th>
				</tr>
			</thead>

			<tbody>
				
				<?php
				

				$getallorder = $ct->getallorder();
				if($getallorder) 
				{
					
				while ($result = $getallorder->fetch_assoc()){
				
				?>

				<tr class="oddgradeX">
					<td hidden><?php echo $result['orderId']?></td>
					<td><?php echo $result['hotenkhach']?></td>
					<td><?php echo $result['sdt']?></td>
					<td><?php echo $result['diachi']?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['quantity']?></td>
					<td><?php echo $fm->format_currency($result['price'])." "."VNĐ"?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="85"></td>
					<td><?php echo $result['paid_date'] ?></td>
					<!-- <td><a href="?idDatHang=<?php echo $result['orderId'] ?>">Xác Nhận Đơn</a></td>					 -->
					<td>
						<?php 
						if($result['status']==0)
						{
						?>
						<a href="?idDatHangXacNhan=<?php echo $result['orderId']?>">Đang chờ Xử Lý</a>
						<?php
						}
						elseif($result['status']==1)
						{
						?>
						<a href="?idDatHangGiaoHang=<?php echo $result['orderId'] ?>">Đã Xử Lý</a>
						<?php
						}
						else
						{
						?>
						<B>Giao hàng</B>
						<?php
						}
					?>
					</td>
					<hr>
					 
				</tr>
				<?php
					}
				}else{
					echo '<span class="error"><center>Hiện tại không có Khách Đặt Hàng. Vui lòng quay lại sau!</center></span><br>';
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

