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
                <?php                     
                    $cart_items = $ct->cart_items();
                    if($cart_items)
                    {
                        while($row = $cart_items->fetch_assoc())
                        {
                            $cart_item = $row['total'];
                        }

                        $limit = 10;
                        // echo gettype($a);
                        $convert_items = (int)$cart_item;
                        // echo gettype($convert_items);
                        // echo $convert_items;

                        if($convert_items >= $limit)
                        {
?>
                            <div class="subnavvv" id="items">
                            <li class="fa fa-shopping-basket"><a href="cart.php#giohangf">GIỎ HÀNG<B> 9+</B></a>
                            <div class="items_cartt" >             
                            </div>
                            </li>
                            </div>
<?php 
                        }
                        elseif(empty($cart_item))
                        {
?>                            
                            <div class="subnavvv" id="items">
                            <li class="fa fa-shopping-basket"><a href="cart.php#giohangf">GIỎ HÀNG<B> 0 </B></a>
                            <div class="items_cartt" >             
                            </div>
                            </li>
                            </div>
<?php
                        }
                        else
                        {
?>                           
                            <div class="subnavvv" id="items">
                            <li class="fa fa-shopping-basket"><a href="cart.php#giohangf">GIỎ HÀNG<B> <?php echo $cart_item ?> </B></a>
                            <div class="items_cartt">             
                            </div>
                            </li>
                            </div>
<?php                            
                        }
                    }
?>                    
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
                    
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
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
        <img id="bg" src="images/index.jpg">
        <div class="text-box">
        <a href="index.php"><img src="images/logo.png" id="avtimg"></a>
            <h1>Cửa Hàng Trang Thiết Bị PC ROSÉ</h1>
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

.items_cartt{
    margin-left: 20px;
}

b, strong{
    color: black;
    border-radius: 5px;
    background-color: white;
    margin-left: 5px;
    padding-left: 1.5px;
    padding-right: 4px;
    width: 100%;
    font-size: 16px;
}

.header .fa{
    margin-top: 1px;
}

.dl, ol, ul{
    margin-right: -30px;
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
setInterval(
    function ()
    {
        $('#items').load(' #items', function(){
            $("#items").css( { marginTop : "-2.5px" } );
        });
    }, 800); // refresh every 10000 milliseconds
</script>



<!-- setTimeout(function(){
   window.location.reload(1);
}, 5000); -->

<script>
    (function(w, d) 
    { 
        w.CollectId = "6418670535dcebd4cb98f775"; 
        var h = d.head || d.getElementsByTagName("head")[0]; 
        var s = d.createElement("script"); 
        s.setAttribute("type", "text/javascript"); 
        s.async=true; 
        s.setAttribute("src", "https://collectcdn.com/launcher.js"); 
        h.appendChild(s); 
    })
    (window, document);
</script>

<script>
    setInterval(autoDelete, 25000);

    function autoDelete()
    {
        $.ajax({
            url: 'classes/action.php',
            type: 'POST',
            data: { auto_delete: "" },
            success: function(data)
            {
                // //console.log(data);
                if(data >= 1)
                {
                    //location.href = "http://localhost/gearmaytinh/admin/produclist.php";
                    //$("#example").load("http://localhost/gearmaytinh/admin/produclist.php" + " #example");
                    //console.log("đã có cái để xóa");
                    // var a = document.getElementById("test").innerText;
                }
                else
                {
                    // alert("không có gì để xóa");
                    //console.log("khong co gi để xóa");
                }
            },
            error: function(xhr, statusText, error)
            {
                alert(xhr.status);
            }
        });
    }
</script>
</body>