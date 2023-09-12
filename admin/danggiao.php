<?php 
    include "inc/header.php";
?>
<?php 
    include "../classes/cartonlinepay.php";
    include "../classes/cart.php";
	include "../classes/thongke.php";
?>

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
$ctonl = new cartonlinepay();
$cart = new cart();
$thongke = new thongke();
$fm = new Format();
?>

<?php 
  if(isset($_GET['option_value']))
  {
    $result = $_GET['option_value'];
    $result_explode = explode('|', $result);
    $madat = $result_explode[0];
    $paid_type = $result_explode[1];
    $confirm = $result_explode[2];

    // echo $madat;
    // echo $paid_type;
    // echo $confirm;

    if($confirm == "shipped")
    {
      $cart->is_shipped($madat, $paid_type);
      
      if($paid_type == "MOMO")
      {
        $ctonl->confirm_cart($madat);
        $thongke->luu_thongke_online($madat);
        echo '<script>windown.location = "http://localhost/gearmaytinh/admin/danggiao.php"</script>';
      }
      else
      {
        $cart->confirm_cart($madat);
        $thongke->luu_thongke_offline($madat);
        echo '<script>windown.location = "http://localhost/gearmaytinh/admin/danggiao.php"</script>';
      }
    }
    else
    {
      $cart->is_cancel($madat, $paid_type);
    }
  }
?>



<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Sản Phẩm Đang Giao</h2></center>
        <div class="block"> 
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
                    <th>Mã Đặt</th>
					<th>Tên Khách Hàng</th>
					<th>SĐT</th>
					<th>Địa Chỉ Giao</th>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Tiền</th>
					<th>Hình Ảnh</th>
					<th>Thời Gian Đặt</th>
					<th>Loại Thanh Toán</th>
					<th>Trạng Thái</th>
                    <th>Xử Lý</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$show_order_is_shipping = $ctonl->show_order_is_shipping();
				if($show_order_is_shipping) 
				{
					
				while ($result = $show_order_is_shipping->fetch_assoc()){
                    $total_price_khongsale = $result['price'];
					$total_price = $result['price'] - ($result['price'] * $result['sale'] / 100); //tổng giá
				?>

				<tr class="oddgradeX">
                    <td><?php echo $result['orderId']?></td>
					<td><?php echo $result['hotenkhach']?></td>
					<td><?php echo $result['sdt']?></td>
					<td><?php echo $result['diachi']?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['quantity']?></td>
                    <td>
<?php                    
					if($result['sale'] == 0)
						{
							echo $fm->format_currency($total_price);
						}
						else
						{
							echo '<del>'.$fm->format_currency($total_price_khongsale)."</del>";
							echo '<B> -'.$result['sale'].'%</B>';
							echo '<br>';
							echo $fm->format_currency($total_price);
						}
?>                  
                    </td>
					<td><img src ="uploads/xuatkho/<?php echo $result['image'] ?>" width="85"></td>
					<td><?php echo $result['paid_date'] ?></td>
					<td><?php echo $result['paid_type'] ?></td>
					 <?php $id = $result['orderId'] ?>
					<td style="width: 8%;">
<?php  
                    if($result['status'] == 2)
                    {
                        echo '<B>Đang Giao</B>';
                    }
                    elseif($result['status'] == 3)
                    {
                        echo '<B>Đã Giao</B>';
                    }
                    else
                    {
                        echo '<B>Đã Huỷ</B>';
                    }
?>                  
                    </td>
                    <td style="width: 12%;">
                    
<?php 
                        if($result['status'] == 3)
                        {
                            echo 'Đã Giao';                         
                        }
                        elseif($result['status'] == 4)
                        {
                            echo 'Đã Hủy';
                        }
                        
                        else
                        {
?>                            
                            <a href="?option_value=<?php echo $result['orderId'] ?>|<?php echo $result['paid_type']?>|shipped">Đã Giao</a> ||
                            <a href="?option_value=<?php echo $result['orderId'] ?>|<?php echo $result['paid_type']?>|cancel">Đã Hủy</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<script>
 $(document).ready(function () 
 {
    //việt hoá ngôn ngữ
    $('#example').DataTable({
        "language": {
        "lengthMenu": "Hiển thị _MENU_ Sản Phẩm",
        "info": "Tổng Sản Phẩm là _TOTAL_",
        "search": "Tìm Sản Phẩm: ",
        "paginate": 
        {
            "first":      "Đầu",
            "last":       "Cuối",
            "next":       "Tiếp",
            "previous":   "Lùi"
        },
        "zeroRecords":    "Không tìm thấy Sản Phẩm này",
        "infoEmpty":      "Tìm thấy 0 Sản Phẩm",
        "infoFiltered":   "(được lọc từ tổng số _MAX_ Sản Phẩm trong danh sách)",
        },
    })
    //gán biến table cho table id example để lấy data
 })
</script>




