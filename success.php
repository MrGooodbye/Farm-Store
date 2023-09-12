<?php include "inc/header.php"; ?>

<?php 
    if(isset($_SESSION['code_cart'])) 
    {
        sleep(2);
        unset($_SESSION['code_cart']);
        // echo $_SESSION['code_cart'];
        // echo $_SESSION['code_cart'];
    }

    elseif(!isset($_SESSION['code_cart']))
    {
        echo '<script>window.location = "404.php#main"</script>';
        // echo 'khong co';
    }
?>


<section class="header">
<a name="main"></a>
      <nav>
        </nav>  
    <!--CART ITEMS DETAIL-->
    <div class="small-container1 cart-page">
        <h1>BẠN ĐÃ ĐẶT HÀNG THÀNH CÔNG. CHÚNG TÔI SẼ LIÊN HỆ VỚI BẠN SỚM NHẤT!</h1>
   </div>
    </section>


<?php include 'inc/footer.php'; ?>

<style>
    h1{
        top: 35%;
        position: relative;
    }
</style>