
<?php include "inc/header.php" ?>
<?php 
    $login_link = "dangnhap.php";
    $login_check = Session::get('customer_login');
    if($login_check == false)
    {
        echo "<script>location.replace('" . $login_link . "')</script>";
    }
?>
<a name="center"></a>
<div class="small-container">
<br>
<h2><center>Chọn loại hình thức thanh toán</center></h2>
<br>
<center>
<a href='thanhtoanvnpay.php#dathang' class='hero-btn2'>Thanh Toán VNPAY</a>
<a href='thanhtoanvnpay.php#dathang' class='hero-btn2'>Thanh Toán MOMO</a>
<a href='thanhtoanvnpay.php#dathang' class='hero-btn2'>Thanh Toán ZaloPay</a>
<a href='thanhtoanvnpay.php#dathang' class='hero-btn2'>Thanh Toán VietComBank</a>
<a href='thanhtoanvnpay.php#dathang' class='hero-btn2'>Thanh Toán AgriBank</a>
<a href='payment.php#focus' class='hero-btn2'>Thanh Toán Tiền Mặt</a>
</center>
</div>


<?php include "inc/footer.php"; ?>

<style>
    .small-container{
        margin-bottom: 20px;
        width: 100%;
    }

    .small-container a{
        margin-bottom: 8px;
        
    }
</style>

