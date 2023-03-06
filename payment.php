<?php include "inc/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

<?php 

?>

<?php    
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
      
      $insertorder = $ct->insert_order($_POST, $customer_id); //dùng $_FILES để chèn thêm hình ảnh
      session_start();
      $_SESSION['code_cart'] = $_POST['code_cart'];
      // header('Location:success.php');
  }
?>


<?php 
  //if(isset($_POST['submit']))
  //{
    // $hotenkhach = $_POST['hotenkhach'];
    // $sdt = $_POST['sdt'];
    // $email = $_POST['email'];
    // $diachi = $_POST['diachi'];
    // $thanhpho = $_POST['thanhpho'];
    // $tensanpham = $_POST['tensanpham'];
    // $soluong = $_POST['soluong'];
    // $tongtien = $_POST['tongtien'];
    // $tonggiatien = $_POST['tonggiatien'];

    // $toemail = 'mrrgooodbyee@gmail.com';
    // $subject = 'Thông Tin đơn hàng của khách hàng' .$hotenkhach;
    // $body = "<h2>Thông Tin Đơn Hàng</h2>";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$hotenkhach."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$sdt."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$email."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$diachi."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$thanhpho."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$tensanpham."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$soluong."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$tongtien."</p>" ."\r\n";
    //   $body .= "<h4>Họ Tên Khách Hàng</h4><p>".$tonggiatien."</p>" ."\r\n";
    

    
    // (mail($toemail, $subject, $body));
    //   ////////
    
  //}

?>

<style>
.body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
  padding-top: 30px;
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
  padding-right: 30px;
}
.col-500{
  display: none;
}

.containerr {
  background-color: #f2f2f2;
  padding: 5px 20px 0px 10px; 
  /* top right bottom left */
  border: 1px solid lightgrey;
  border-radius: 20px;
  overflow:hidden;
  height:1%;
  margin-right: 50px;
  
}

.containerr p{
  margin-bottom: 0px;
}

input[type=text] {
  width: 75%;
  margin-bottom: 10px;
  padding: 13px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.btn {
  background-color: #04AA6D;
  color: white;
  margin: auto;
  border: none;
  width: 20%;
  border-radius: 10px;
  cursor: pointer;
  font-size: 17px;
  text-align: center;
  display: flex;
  justify-content: center;
  margin-bottom: 10px;
  margin-right: 580px;
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

span.a{
  padding-right: 7px;
}

span.price {
  padding-left: 7px;
  color: grey;
  float: right;
  padding-bottom: 15px;
}

 span.price b{
  color: deeppink;
  padding-right: 15px;
  font-size: 16.5px;
  font-family: "Times New Roman";
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

<a name="focus"></a>
<div class="body" id="dathang">

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
            <label for="fname"><i class="fa fa-user"></i>Họ Tên Nguời Nhận</label>
            <input type="text" id="fname" name="hotenkhach">
            <label for="email"><i class="fa fa-phone"></i> Số Điện Thoại</label>
            <input type="text" id="email" name="sdt">
            <!-- <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email"> -->
            <label for="adr"><i class="fa fa-address-card-o"></i> Địa Chỉ</label>
            <input type="text" id="adr" name="diachi">
            <label>
              <input type="checkbox" name="sameadr" checked disabled>Thanh Toán Khi Nhận Hàng</input>
            </label>
          </div>

          <div class="containerr">
          <a href="cart.php"><h4>Giỏ Hàng<span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b></b></span></h4></a>
          <?php 

                        $get_product_cart = $ct->get_product_cart();
                        if($get_product_cart){
                            $subtotal = 0;
                            while($result = $get_product_cart->fetch_assoc()){
                    ?>
          <input type="hidden" value="<?php echo $result['code_cart_online'] ?>" name="code_cart"></input>
          <p><B><span class="a" name="tensanpham"><?php echo $result['productName'] ?> </span></B> <span class="price" name="soluong"> Số Lượng: <?php echo $result ['quantity'] ?> </span> 

          <span class="price" name="tongtien1mon"><?php   
                            $total = $result['price'] * $result['quantity']; 
                            echo $fm->format_currency($total)." "."VNĐ";   
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
          
          <span class="price" style="color:black" name="tonggiatien">
          <B><b>
          Tổng Giá Tiền:
            <?php
                                echo $fm->format_currency($subtotal)." "."VNĐ";
                            ?>

          </b></B>
          </span>

          <?php }else 
                    {   
                        echo "<script>window.location = 'cart.php'</script>";
                    }
          ?>

        </div>
        </div>
      </div>
</div>
</div>
<br>
<input type ="submit" name="submit" class="btn" value="Đặt Hàng"></a>
</form>
</div>



<?php include "inc/footer.php"; ?>