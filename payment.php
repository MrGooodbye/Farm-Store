<?php include "inc/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php 
    
        $login_check = Session::get('customer_login');
            if($login_check == false)
            {
                header('Location:dangnhap.php');
            }    

?>



<?php    
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
      
      $insertorder = $ct->insert_order($_POST); //dùng $_FILES để chèn thêm hình ảnh
      $delcart = $ct->del_all_data_cart();
      header('Location:success.php');
  }
?>







<style>
.body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 0%; /* IE10 */
  flex: 13%;

}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}
.col-500{
  display: none;
}

.containerr {
  background-color: #f2f2f2;
  padding: 5px 20px 0px 20px; 
  /* top right left bottom */
  border: 1px solid lightgrey;
  border-radius: 3px;
}

.containerr .p{
  color: red;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

button {
   /* Green */

  
  float: center;

}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}






</style>

<div class="body">

<center><h2>Thông Tin Đơn Hàng</h2></center>
</br>
<form action="" method="post">
<div class="row">
  <div class="col-75">
    <div class="container">
      
         <?php
            if(isset($insertorder)){
                echo $insertorder;
            }
        ?>  
        <div class="row">
          <div class="col-50">
            <h3>Thông Tin Giao Hàng</h3>
            <label for="fname"><i class="fa fa-user"></i>Họ Tên</label>
            <input type="text" id="fname" name="hotenkhach">
            <label for="email"><i class="fa fa-phone"></i> Số Điện Thoại</label>
            <input type="text" id="email" name="sdt">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Địa Chỉ</label>
            <input type="text" id="adr" name="diachi">
            <label for="city"><i class="fa fa-home"></i> Thành Phố</label>
            <input type="text" id="city" name="thanhpho">
            <label>
              <input type="checkbox" checked="checked" name="sameadr"> Thanh Toán Khi Nhận Hàng
            </label>
          </div>

          <div class="col-50">
            <h3>Thanh Toán Online</h3>
            <label for="fname">Chúng Tôi Chấp Nhận</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
              <i class="fa fa-cc-paypal" style="color:blue;"></i>
            </div>
            <label for="cname">Tên Tài Khoản</label>
            <input type="text" id="cname" name="cardname" >
            <label for="ccnum">Mã Số Thẻ</label>
            <input type="text" id="ccnum" name="cardnumber">
            <label for="expmonth">Tháng Hết Hạn</label>
            <input type="text" id="expmonth" name="expmonth">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Năm Hết Hạn</label>
                <input type="text" id="expyear" name="expyear">
              </div>
              <div class="col-50">
                <label for="cvv">Mã Định Danh</label>
                <input type="text" id="cvv" name="cvv">
              </div>
            </div>
          </div>
        </div>
        
    </div>
  </div>
  <div class="col-25">
  </br>
  </br>
  </br>
    <div class="containerr">
      <a href="cart.php"><h4>Giỏ Hàng<span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b></b></span></h4></a>
       <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        $subtotal = 0;
                        while($result = $get_product_cart->fetch_assoc()){
                ?>
      <p><B><span class="a" name="tensanpham"><?php echo $result['productName'] ?> </span></B> <span class="price" name="soluong"> Số Lượng: <?php echo $result ['quantity'] ?> </span> 

      <span class="price" name="tongtien1mon"><?php   
                        $total = $result['price'] * $result['quantity']; 
                        echo $total . " VNĐ";   
                    ?>     
      </span> </p>
      </p>



       <?php 
                    $subtotal += $total;
                     }
                  }

        ?>



      <hr>
       <?php
                    $check_cart = $ct->check_cart();
                            if($check_cart){  
                    ?> 

      <p>Tổng Tiền<span class="price" style="color:black" input type= "text" name="tongtien"><b> <?php echo $subtotal .' ' .'VNĐ'; ?></b></span></p>
      <p>Thuế VAT<span class="price" style="color:black"><b>10%</b></span></p>
      <p>Tổng Giá Tiền<span class="price" style="color:black" name="tonggiatien">
      <b>
        
        <?php 
                            
                            $vat = $subtotal * 0.1;
                            $gtotal = $subtotal + $vat;
                            echo $gtotal .' ' .'VNĐ';
                        ?>

      </b></span></p>

      <?php }else 
                {   

                    echo '<div class="alert"><B>Giỏ Hàng của bạn hiện tại không có Sản Phẩm nào.</B></div>';
                }
        ?>

    </div>
  </div>
</div>
<input type ="submit" name="submit" class="btn" value="Đặt Hàng"></a>
</form>
</div>



<?php include "inc/footer.php"; ?>