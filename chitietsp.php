<?php include "inc/header.php"; ?>



<?php

if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
    $id = $_GET['proid'];
    }

?>


<?php 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      $quantity = $_POST['quantity'];
      $AddtoCart = $ct->add_to_cart($quantity, $id);

  }


?>






<?php 
    
    $get_product_details = $product->get_details($id);
    if($get_product_details){
        while($result_details = $get_product_details->fetch_assoc()){
    
?>




<style>input[type="submit"] {padding-right: 50px;}</style>





<!--THÔNG TIN SẢN PHẨM 1-->
<div class="small-container single-product">
    <div class="row1">
        <div class="col-2">
            <img src="admin/uploads/<?php echo $result_details['image'] ?>" width="200%" id="ProductImg">

        </div>



        <div class="col-2">
            <p> <a href="chitietsp.php">Trang Chủ</a> -> Danh Mục <?php echo $result_details['catName'] ?> -> <?php echo $result_details['productName'] ?></p>
            <h1><?php echo $result_details['productName'] ?></h1>
            <h4><?php echo $result_details['price']." "."VNĐ" ?> / KG</h4>
            <h4>Loại Sản Phẩm: <?php echo $result_details['catName'] ?> </h4>
            <div class="add-cart">
                    <form action="" method="post">
                        <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
                        <input type="submit" class="buysubmit" name="submit" value="Mua"/>
                    </form>
                     <?php 
                            if(isset($AddtoCart)){
                                echo $AddtoCart;
                            }
                        ?>
            </div>
        </br>
        </br>
            <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
            <p><?php echo $result_details['product_desc'] ?></p>
        </div>
    </div>
</div>





<?php
    }
}
?>





<!--js for product gallery(làm hiệu ứng chuyển ảnh sản phẩm khi click)-->
<script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("small-img");
    SmallImg[0].onclick=function()
    {
        ProductImg.src=SmallImg[0].src;
    }
    SmallImg[1].onclick=function()
    {
        ProductImg.src=SmallImg[1].src;
    }
    SmallImg[2].onclick=function()
    {
        ProductImg.src=SmallImg[2].src;
    }
    SmallImg[3].onclick=function()
    {
        ProductImg.src=SmallImg[3].src;
    }
</script>



<?php include 'inc/footer.php'; ?>
    