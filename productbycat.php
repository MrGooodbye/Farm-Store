<?php include "inc/header.php"; ?>

<?php 
    
    
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
        $id = $_GET['catid'];
    }




?>


<!--Danh sách sản phẩm Cần Câu-->
<div class="small-container">

    <div class="row1 row-2">
         <?php 
            $name_cat = $cat->get_name_by_cat($id);
            if($name_cat){
                $result_name = $name_cat->fetch_assoc();{

        ?>
        <h2>Loại Sản Phẩm <?php echo $result_name['catName']?></h2>
        <select onchange="location = this.value;">
            <option value="sanpham.php">Tất Cả Loại</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=48">Củ</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=43">Rau Xanh</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=42">Quả</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=51">Gạo</option>
        </select>
        <?php 
            }
        }
    ?>
    </div>
    <?php 
            $name_cat = $cat->get_name_by_cat($id);
            if($name_cat){
                $result_name = $name_cat->fetch_assoc();{

    ?>

    <h2 class="title">Sản Phẩm <?php echo $result_name['catName'] ?></h2>

    <?php 
            }
        }
    ?>
    
    <div class="row1">
         <?php 
            $productbycat = $cat->get_product_by_cat($id);
            if($productbycat){
            while($result = $productbycat->fetch_assoc()){

        ?>
        <div class="col-4">
            <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?> " id="popcornmakers"></a>
            <h4><?php echo $result['productName'] ?></h4>
            <div class="rating">
                <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <p>Giá: <?php echo $result['price'] ?> VNĐ</p>
            </div>
            
        </div>
         <?php 
            }
        }else{
            echo "Danh Mục bạn chọn hiện tại không có Sản Phẩm nào. Vui lòng thử lại sau!";

        }
    ?>

    </div>


    <style>#popcornmakers {width: 250px;}</style>

   

<!--Tạo link truy cập danh sách sản phẩm-->
</br>
</br>
<div class="page-btn">
    <span>1</span>
    <span>2</span>
    <span>3</span>
    <span>4</span>
    <span>&#8594;</span>
</div>
</div>
</div>






<?php include 'inc/footer.php'; ?>