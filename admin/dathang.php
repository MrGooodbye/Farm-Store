<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/cart.php"; ?>
<?php include_once "../helper/format.php"; ?>



<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 15px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
                   th {padding-right: 48px;}
</style>






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
					<th>Thành Phố</th>
					<th>Mã Sản Phẩm</th>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Tiền</th>
					<th>Hình Ảnh</th>
					<th>Xử Lý</th>
				</tr>
			</thead>

			<tbody>
				
				<?php

				$ct = new cart();

				if(isset($_GET['idDatHang'])){
					$Id = $_GET['idDatHang'];
					$delorder = $ct->del_order($Id);
				}

					if(isset($delorder)){
        			echo $delorder;
        		}


				$getallorder = $ct->getallorder();
				if($getallorder) {
					
				while ($result = $getallorder->fetch_assoc()){
				
				?>

				<tr class="oddgradeX">
					<td hidden><?php echo $result['orderId']?></td>
					<td><?php echo $result['hotenkhach']?></td>
					<td><?php echo $result['sdt']?></td>
					<td><?php echo $result['diachi']?></td>
					<td><?php echo $result['thanhpho']?></td>
					<td><?php echo $result['productId']?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['quantity']?></td>
					<td><?php echo $result['price']?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="85"></td>
					<td><a href="?idDatHang=<?php echo $result['orderId'] ?>">Xác Nhận Đơn</a></td>					
					
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

