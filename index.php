<?php include "inc/header.php"; ?>








<!--Course -->
    <section class="course">
        <div class="content">
        <h1>Sản Phẩm Nổi Bật</h1>
        <p>Những sản phẩm được nhiều người mua ở cửa hàng, bao gồm các loại Card Đồ Hoạ, Chip Điện Tử, Tay Cầm,...</p>
        <?php
            $product_featured = $product->getproduct_featured();
            if($product_featured) {
                while ($result = $product_featured->fetch_assoc()){
        ?>

            <div class = "grid_1_of_4 images_1_of_4">
                <a href="chitietsp.php ?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>"  alt="" /></a>
                <h2><?php echo $result['productName'] ?></h2>
                <p><?php echo $fm->textShorten($result['product_desc'], 100) ?></p>
                <p><B><span class ="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></B></p>
                <div class=buttton><span><a href="chitietsp.php ?proid=<?php echo $result['productId'] ?> class="details">Xem Chi Tiết </a></span></div>
            </div>

            <?php
            }
            }
            ?>


            <style>.grid_1_of_4 {
                display: block;
                float: left;
                margin: 1% 13px;
                box-shadow: 0px 0px 3px rgb(150, 150, 150);}


                .grid_1_of_4:first-child { 
                margin-left: 0px; } 

                .images_1_of_4 {
                width: 17.8%;
                padding:1.5%;
                text-align:center;
                position:relative; }

                .images_1_of_4  img{
                max-width:100%; }


                
            </style>





        </div>
        <p>.</p>
    </section>


        <section class="course">
        
    </br>
    
        <h2>Danh Mục Sản Phẩm</h2>

        <div class="row">

        <?php 

            $getall_category = $cat->show_category_fontend(); 
            if($getall_category){
                while($result_allcat = $getall_category->fetch_assoc()){
        

        ?>
            <div class="course-col">
                <h3><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?> "> <?php echo $result_allcat['catName'] ?> </a>
            </div>

        <?php 
            }
                }
        ?>

        </div>
    
    </section>

<!--facilities-->
<section class="facilities">
    <h1>Các Cửa Hàng Của Chúng Tôi</h1>
    <p>Mở cửa từ Thứ 2 đến Thứ 6 <br>Sáng :6h-11h <br>Chiều :13h-17h </p>
    <div class="row">
        <div class="facilities-col">
            <img src="images/Chi-15m2-cua-hang-nong-san-khong-thuoc-tru-sau-lam-nhut-mat-khach-hang-cua-hang-sach-anh-1524450590-width620height465.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Hà Nội</h3>
            <p>24 Phố Quảng Bá, Quảng An, Tây Hồ, Hà Nội</p>
        </div>
        <div class="facilities-col">
            <img src="images/song-sach-tai-nong-san-nha-que-co-so-1.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Huế</h3>
            <p>8 Nguyễn Bỉnh Khiêm, Phú Cát, Thành phố Huế, Thừa Thiên Huế</p>
        </div>
        <div class="facilities-col">
            <img src="images/unnamed.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Sài Gòn</h3>
            <p>77 Quốc lộ 1A , khu phố 2, phường hiệp bình phước , thành phố mới thủ đức</p>
        </div>
    </div>
</section>
<!--CALL TO ACTION-->
<section class="cta">
    <h1>Liên Hệ Với Chúng Tôi <br>Bất Cứ Khi Nào Bạn Cần</h1>
 <!--hero-btn đã tạo sẵn nên chỉ cần gắn class vào là sẽ có nút sẵn -->
    <a href="lienhe.php" class="hero-btn">LIÊN HỆ NGAY</a>
</section>

<?php include 'inc/footer.php'; ?>