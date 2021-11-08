    <?php include "inc/header.php"; ?>








<!--Danh sách sản phẩm Đồ câu-->
<div class="small-container">

    <div class="row1 row-2">
        <h2>Sản Phẩm Theo Loại</h2>
        <select onchange="location = this.value;">
            <option value="sanpham.php">Tất Cả Loại</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=48">Củ</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=43">Rau Xanh</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=42">Quả</option>
            <option value="http://localhost/nongsan/productbycat.php?catid=51">Gạo</option>
        </select>
    </div>
   
    <div class="row1">
         <?php 

    $getallproduct = $product->getallproduct();
    if($getallproduct) {
        while ($result = $getallproduct->fetch_assoc()){


    ?>
        <div class="col-4">
            <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?> " id="popcornmakers"></a>
            <h4><?php echo $result['productName']?></h4>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <p>Giá: <?php echo $result['price']?> VNĐ</p>
    
        </div>
        <?php
            }
            }
            ?>
    </div>


<style>#popcornmakers {width: 315px;}</style>






</div>

<?php include 'inc/footer.php'; ?>