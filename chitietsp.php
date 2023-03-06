<?php include "inc/header.php"; ?>



<?php

if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
    $id = $_GET['proid'];
    $id_sanpham = $_GET['proid'];
    }

?>


<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) 
    {
        $quantity = $_POST['quantity'];
        $AddtoCart = $ct->add_to_cart($quantity, $id);
    }
    elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitt']))
    {
        $quantity = $_POST['quantity'];
        $AddtoCartt = $ct->add_to_cartt($quantity, $id);
    }
?>

<a name="chitietsanpham"></a>
<?php 
    
    $get_product_details = $product->get_details($id);
    if($get_product_details){
        while($result_details = $get_product_details->fetch_assoc()){
    
?>

<style>input[type="submit"] {padding-right: 145px;}</style>



<!--THÔNG TIN SẢN PHẨM 1-->
<div class="small-container single-product"> 
    <div class="row1"> 
        <div class="col-2"> 
            <img src="admin/uploads/<?php echo $result_details['image'] ?>" width="200%" id="ProductImg">

        </div>



        <div class="col-2"> 
            <p> <a href="index.php">Trang Chủ</a> - Danh Mục <?php echo $result_details['catName'] ?> - <?php echo $result_details['productName'] ?></p>
            <h1><?php echo $result_details['productName'] ?></h1>
            <h4><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></h4>
            <h4>Loại Sản Phẩm: <?php echo $result_details['catName'] ?> </h4>
            <h4>Tình Trạng: 
                <?php 
                    if($result_details['solg_from_storage'] <= 0)
                    {echo "<font color=\"red\">Hết Hàng</font>";}
                    else{echo "<font color=\"blue\">Còn Hàng</font>";}
                ?>
            </h4>
            <div class="add-cart">
                    <form action="" method="post" id="muaban">
                        <input type="number" class="buyfield" name="quantity" value="1" min="1" id="soluong"/>
                        <input type="submit" class="buysubmit" name="submit" value="Thêm vào giỏ"/>
        </br>
        </br>

                        <input type="submit" class="buysubmit" name="submitt" value="Mua Ngay"/>
                    </form>
                     <?php 
                            if(isset($AddtoCart)){
                                echo $AddtoCart;
                            }
                            if(isset($AddtoCartt))
                            {
                                echo $AddtoCartt;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $(document).ready(function()
    {
        var idsanpham = <?php echo $id_sanpham ?>;
        // console.log(idsanpham);
        var check = null;
        $.ajax({
                url: 'classes/action.php',
                type: 'GET',
                data:{ checkpd: idsanpham },
                success: function(data, status)
                {
                    // alert(data.Quantity);
                    // gán số lượng được lấy từ database = ajax bằng biến check
                    check = data.Quantity;
                    if(check == 0)
                    {
                        $(".buyfield").css("cursor", "not-allowed");
                        $(".buysubmit").css("cursor", "not-allowed");
                        $(':input[type="submit"]').prop('disabled', true);
                    }
                    
                    else
                    {
                        $(document).on('input', '#soluong', function(){
                            var soluong = $("#soluong").val();
                            var conlai = check - soluong;
                            if(conlai < 0)
                            {
                                $(".buyfield").css("cursor", "not-allowed");
                                $(".buysubmit").css("cursor", "not-allowed");
                                $(':input[type="submit"]').prop('disabled', true);
                            }
                            else
                            {
                                $(".buyfield").css("cursor", "auto");
                                $(".buysubmit").css("cursor", "auto");
                                $(':input[type="submit"]').prop('disabled', false);
                            }
                         })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown, data)
                {
                    console.log(data);
                }
               
            });

    });
</script>



<?php include 'inc/footer.php'; ?>
    