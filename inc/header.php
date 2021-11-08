<?php
    include 'lib/session.php';
    Session::init();
?>


<?php 
    include "lib/database.php";
    include "helper/format.php";

    spl_autoload_register(function($class)
    {
        include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $us = new user();
    $cat = new category();
    $cs = new customer();
    $product = new product();
?>







<!DOCTYPE html>
<html>
<head>
    <!--Lệnh meta này sẽ giúp điều chỉnh view(khung hình) 
        hợp lý khi dùng các thiết bị-->
    <meata name="viewport" content="with=device-width, initial-scale=1.0"> 
    <title>Cửa Hàng Nông Sản AK </title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  
    <!--Link này lấy trong video dùng để tạo icon trên trang web , còn link trong web bootrapcdn ko dùng được ko xài đc-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.php"><img src="images/logo4.png"  ></a>
            <div class="nav-links" id="navLinks">
                <!--Gắn thẻ i class vào để đặt icon close vô thanh menu -->
                <i class="fa fa-times" onclick="hideMenu()"></i>               
                <ul>
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php">GIỚI THIỆU</a></li>

                    <div class="subnavvv">
                    <li class="fa fa-shopping-basket"><a href="cart.php">GIỎ HÀNG</a></li>
                    </div>

                    <?php 
                        if(isset($_GET['customer_id'])){
                            Session::destroy();
                            header("Location:index.php");
                        }
                    ?>
                     <div class="subnavv">
                    <?php 
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
                            echo '<li><a href="dangnhap.php">ĐĂNG NHẬP</a></li>';
                            echo '<li><a href="dangkyacc.php">ĐĂNG KÝ</a></li>';
                        }else{
                             echo '<li><a href="?customer_id='.Session::get('customer_id').'">ĐĂNG XUẤT</a></li>';
                            
                        }    
                    ?>

                    </div>



                    <div class="subnavv">
                        <li><a href="lienhe.php">LIÊN HỆ</a></li>
                        
                    </div>

                    <div class="subnavv">
                        <li><a href="sanpham.php">SẢN PHẨM</a></li>
                    </div>

                    

                    <div class="subnavv">
                        <li><a href="noicau.php">NÔNG SẢN SẠCH</a></li>
                        
                    </div>
                    
                </ul>
            </div>
            <
            <!--Gắn thẻ i class vào để đặt icon menu vô thanh menu -->
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>  
        <div class="text-box">
            <h1>Cửa hàng Nông Sản Anh Kiệt</h1>
            <p>
                Kính chào khách hàng đã đến với Cửa hàng nông sản Anh Kiệt .Tại đây chúng tôi luôn lắng nghe và phục vụ khách hàng 24/24 .
                <br>Địa chỉ: 77 Quốc lộ 1A,khu phố 2,phường Hiệp Bình Phước,thành phố mới thủ đức. SĐT: 0909415553  
            </p>
            <a href="gioithieu.php"class="hero-btn">Nhấn vào đây để biết thêm về chúng tôi</a>
        </div>     
        </section>

    <style>
.subnav-contentt {
  display: none;
  left: 0;
  position: absolute;
  width: 79.5%;
}

.subnavv:hover .subnav-contentt {
  display: block;
}

.subnavv {
float: right;
overflow: hidden;
}

.subnavvv{
    float: right;
overflow: hidden;
    padding-top: 2.8px;
}
        
</style>



    