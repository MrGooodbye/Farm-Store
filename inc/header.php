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

    //file class phải đúng tên file mới include và tên class bắt buộc phải đặt đúng theo tên file

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cat = new category();
    $cs = new customer();
    $product = new product();
    $ctonline = new cartonlinepay();
?>

<!DOCTYPE html>
<html>
<head>
    <!--Lệnh meta này sẽ giúp điều chỉnh view(khung hình) 
        hợp lý khi dùng các thiết bị-->
    <meata name="viewport" content="with=device-width, initial-scale=1.0"> 
    <title>Cửa Hàng Trang Thiết Bị PC ROSÉ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  
    <!--Link này lấy trong video dùng để tạo icon trên trang web , còn link trong web bootrapcdn ko dùng được ko xài đc-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://kit.fontawesome.com/d5e3c07cf1.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
    
        <nav id="navvbar">
            
            <div class="nav-links" id="navLinks">
                <!--Gắn thẻ i class vào để đặt icon close vô thanh menu -->
                <i class="fa fa-times" onclick="hideMenu()" id="menubbar"></i>               
                <ul id="menuitem">
                    
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
                    

                    
                    <div class="subnavvv">
                    <li class="fa fa-shopping-basket"><a href="cart.php#giohangf">GIỎ HÀNG</a></li>
                    </div>
                   
 
                    <?php 
                        if(isset($_GET['customer_id']))
                        {
                            unset($_SESSION['customer_login']);
                            header("Location:index.php");
                        }
                    ?>
                     <div class="subnavv">
                    <?php 
                        $login_check = Session::get('customer_login');
                        if($login_check == false)
                        {
                            echo '<li><a href="dangnhap.php#dangnhap">ĐĂNG NHẬP</a></li>';
                            echo '<li><a href="dangkyacc.php#dangky">ĐĂNG KÝ</a></li>';
                        }
                        else
                        {
                            echo '<li><a href="thongtinkhachhang.php#main">TÀI KHOẢN CỦA BẠN</a></li>'; 
                            echo '<li><a href="donhangcuaban.php#main">ĐƠN HÀNG CỦA BẠN</a></li>'; 
                            echo '<li><a href="?customer_id='.Session::get('customer_id').'">ĐĂNG XUẤT</a></li>';
                        
                        }  
                      
                    ?>

                    </div>


                    <div class="subnavv">
                        <li><a href="sanpham.php#sanpham">SẢN PHẨM</a></li>
                    </div>

                    <div class="subnavv">
                        <li><a href=" lienhe.php#contact">LIÊN HỆ</a></li>
                        
                    </div>

                   

                    
                </ul>
            </div>
            <!--Gắn thẻ i class vào để đặt icon menu vô thanh menu -->
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>  
        <div class="text-box">
        <a href="index.php"><img src="images/logo.png" id="avtimg"></a>
            <h1>Cửa Hàng Trang Thiết Bị PC ROSÉ</h1>
            <p>
                Kính chào khách hàng đã đến với Cửa Hàng Trang Thiết Bị PC ROSÉ. Tại đây chúng tôi luôn lắng nghe và phục vụ khách hàng 24/24 .
                <br>Địa chỉ: 69A, khu phố 96, phường Hiệp Bình Chánh, Thành Phố Thủ Đức, Thành Phố Thành Phố Hồ Chí Minh. SĐT: 0969966996  
            </p>
            <a href="gioithieu.php"class="hero-btn">Biết thêm về chúng tôi</a>
        </div> 
            
    </div>

     

       

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

.subnavv{
    margin: auto 0 auto auto;
}

#avtimg{
    width: 120px;
    height: 120px; 
    float: left;
}
        
</style>

<script>
//    let nav = document.querySelector("nav");
//    window.addEventListener("scroll", ()=>
//    {
//     if(document.documentElement.scrollTop > 20)
//     {
//         nav.classList.add("sticky");
//     }
//    }
//    )

var navbar = document.getElementById("navvbar");
var menu = document.getElementById("menuitem");

window.onscroll = function()
{
    if(window.pageYOffset > menu.offsetTop)
    {
        navbar.classList.add("sticky");
    }
    else
    {
        navbar.classList.remove("sticky");
    }
}

</script>



    