<?php include "inc/header.php"; ?>

<?php 
    $login_link = "dangnhap.php";
        $login_check = Session::get('customer_login');
            if($login_check == false)
            {
                echo "<script> location.replace('" . $login_link . "')  </script>";
            }    
            else
            {
                $customer_id = Session::get('customer_id');
                // echo $customer_id;
            }
?>

<style>
    .container {  
      width: 100%;
      
  }  

  #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers th {
  padding-top: 20px;
  padding-right: 10px;
  text-align: center;
  background-color: #0000;
  color: black;
  font-size: 16px;
}

#customers td{
    text-align: center;
    padding-top: 0px;
}

    .avatar {
  width: 120px;
  height: 100px;
  border-radius: 50%;
  overflow: hidden;
  float: left;
}

.U{
    color: violet;
}

.pop{
 width: 90%;
 height: 300px;
}


.popup{
  width: 95%;
  height: 312px;
  margin-top: 215px;
  background-color: #fff;
  position: fixed;
  z-index: 10000;
  margin-left: 37px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: none;
  border-radius: 22px;
}

.popup h4{
  color: red;
}

#fa{
  margin-left: 98.1%;
  cursor: pointer;
}

#details th{
  padding-top: 10px;
  padding-right: 12px;
  text-align: center;
  background-color: #0000;
  color: black;
}

#details td{
  text-align: center;
  
}

#popup1{
  -webkit-box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
  box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
}

</style>


<?php 
  if(isset($_GET['madon']))
  {
    $order_id = $_GET['madon'];
    $paid_type = $_GET['loaipaid'];
    $show_order_details = $cs->show_order_details($order_id, $paid_type);
?>
       
        <div class="popup" id="popup1"> 
        <a href="donhangcuaban.php#main"><i class="fa-sharp fa-solid fa-circle-xmark fa-2x" id="fa"></i></a>
        <h4><center>Chi Tiết Đơn Hàng</center></h4>
        <hr>
          <table id="details">
          
            <tr>
              <th><B>Tên Sản Phẩm</B></th>
              <th><B>Số Lượng</B></th>
              <th><B>Tổng Giá Tiền</B></th>
              <th><B>Hình Ảnh</B></th>
              <th><B>Thời Gian Mua</B></th>
              <th><B>Loại Thanh Toán</B></th>
              <th><B>Trạng Thái</B></th>
              <th><B>Người Nhận</B></th>
              <th><B>Số Điện Thoại</B></th>
              <th><B>Địa Chỉ Nhận</B></th>
            </tr>
<?php                        
    if($show_order_details)
    {
      while($result_show = $show_order_details->fetch_assoc())
      {
?>        
        <tr>
          <td><?php echo $result_show['productName']?></td>
          <td><?php echo $result_show['quantity']?></td>
          <td><?php echo $fm->format_currency($result_show['price'])." VNĐ"?></td>
          <td><img src ="admin/uploads/xuatkho/<?php echo $result_show['image'] ?>" width="80"></td>
          <td><?php echo $result_show['paid_date']?></td>
          <td><?php echo $result_show['paid_type']?></td>
          <td>
        <?php 
                if($result_show['status']==0)
                {
                ?>
                <B>Đang chờ xử lý...</B>
                <?php
                }
                elseif($result_show['status']==1){
                ?>
                <B>Đã được xử lý</B>
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
          <td><?php echo $result_show['hotenkhach']?></td>
          <td><?php echo $result_show['sdt']?></td>
          <td id="diachi"><?php echo $result_show['diachi']?></td>
        </tr>
<?php      
      }
    }
  elseif(isset($_GET['id_sanpham']))
    {
      $doi_tra_id_sanpham = $_GET['id_sanpham'];
    }
  }
?>
</table>
</div>


<a name="main"></a>
<div class="container">  
<?php 
      $id = Session::get('customer_id');
      $get_customers = $cs->show_customers($id);
      if($get_customers)
      {
        while($result = $get_customers->fetch_assoc())
        { 
?>
<?php
  $img = $result['image'];
  if($img == NULL)
  {
?>
    <image src="images/b.jpg" class="avatar">
<?php  
  }    
  else
  {
?>
    <img src ="avt/<?php echo $result['image'] ?>"  class="avatar">    
  <?php
  }
?>

    <h6><br> <?php echo $result['username'] ?></h6>
<?php
    
        }
      }
?>


<center><B><U>ĐƠN HÀNG CỦA BẠN</U></B></center>

<br>
<br>
<table id="customers">
    <thead>
    <br>
<?php 
   $show_order = $cs->show_order($id);
   if($show_order)
   {
?>
   
    <tr>
      <th><B>Tên Sản Phẩm</B></th>
      <th><B>Số Lượng</B></th>
      <th><B>Tổng Giá Tiền</B></th> 
      <th><B>Hình Ảnh</B></th>
      <th><B>Thời Gian Mua</B></th>
      <th><B>Loại Thanh Toán</B></th>
      <th><B>Trạng Thái</B></th>
      <th><B>Chi Tiết</B></th>
    </tr>
    <thead>
    
    <tbody>
<?php
    while ($result = $show_order->fetch_assoc())
    {
      $total_price_khongsale = $result['price'];
			$total_price = $result['price'] - ($result['price'] * $result['sale'] / 100); //tổng giá
?>
      
      <tr>
        <td><?php echo $result['productName']?></td>
        <td><?php echo $result['quantity']?></td>
        <td>
<?php 					if($result['sale'] == 0)
						{
							echo $fm->format_currency($total_price);
						}
						else
						{
							echo '<del>'.$fm->format_currency($total_price_khongsale)."</del>";
							echo "<font color=\"blue\"> -".$result['sale']."%</font>";
							echo '<br>';
							echo "<B><font color=\"deeppink\">".$fm->format_currency($total_price)."</font></B>";
						}
?>
					</td>
        <td><img src ="admin/uploads/xuatkho/<?php echo $result['image'] ?>" width="80"></td>
        <td><?php echo $result['paid_date'] ?></td>
        <td><?php echo $result['paid_type']?></td>
        <td>
        <?php 
                if($result['status']==0)
                {
                  echo '<B>Đang chờ xử lý</B>';
                }
                elseif($result['status']==1)
                {
                  echo '<B>Đã được xử lý</B>';  
                }
                elseif($result['status']==3)
                {
                  echo '<B>Đã nhận hàng</B>';
                }
                elseif($result['status']==4)
                {
                  echo '<B>Đã hủy</B>';
                }
                else
                {
                  echo '<B>Đang giao hàng</B>';
                }
        ?>
        </td>
        <td>
        <a href="donhangcuaban.php?madon=<?php echo $result['orderId']?>&loaipaid=<?php echo $result['paid_type']?>#main" >Xem chi tiết</a>
        </td>
      </tr>
<?php
    } 
  }
  else
  {
    echo '<span class="error"><center><br>Hiện tại quý khách chưa có đơn hàng nào được mua tại cửa hàng chúng tôi.</center></span><br>';
  }
?>
 </tbody>
</table>
</div>
<hr>
<br>

<?php include 'inc/footer.php'; ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

<script>
$(document).ready(function () 
{
  var table = $('#customers').DataTable();
})
</script>

