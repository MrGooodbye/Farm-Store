<?php include "inc/header.php"; ?>








<!--Course -->
    <section class="course">
        <div class="content">
        <h1>Sản Phẩm Nổi Bật</h1>
        <p>Những sản phẩm được nhiều người mua ở cửa hàng , bao gồm các loại rau , củ , quả....</p>
        <?php
            $product_featured = $product->getproduct_featured();
            if($product_featured) {
                while ($result = $product_featured->fetch_assoc()){
        ?>

            <div class = "grid_1_of_4 images_1_of_4">
                <a href="chitietsp.php ?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>"  alt="" /></a>
                <h2><?php echo $result['productName'] ?></h2>
                <p><?php echo $fm->textShorten($result['product_desc'], 100) ?></p>
                <p><span class ="price"><?php echo $result['price']." "."VNĐ" ?></span></p>
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
                <h3><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?> "> <?php echo $result_allcat['catName'] ?> </a></h3><p>Chuyên bán rau , củ, quả, các loại nông sản khác. Nhiều chính sách ưu đãi khi mua , giao hàng tận nơi và hỗ trợ tư vấn mọi nhu cầu khách hàng muốn giải quyết .</p>
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
<!--testimonials-->
<section class="testimonials">
    <h1>Khách Hàng Của Chúng Tôi Nghĩ Gì Khi Đến Cửa Hàng </h1>
    <p>Đối với cửa hàng chúng tôi , niềm vinh hạnh lớn nhất là được phục vụ khách hàng , hỗ trợ tất cả các nhu cầu mà khách hàng cần.Vì vậy cửa hàng cũng được rất nhiều khách hàng tin dùng và ủng hộ .</p>
    <div class="row">
        <div class="testimonials-col">
            <img src="images/Ronaldo.jpg">
            <div>
                <p>Cristiano Ronaldo nói :"Tôi đã từng dùng rất nhiều sản phẩm nhưng chưa bao 
                    giờ tôi thấy hài lòng cho đến khi tôi biết đến cửa hàng đồ câu cá Anh Kiệt .Quả thật đây là nơi mà tôi tìm kiếm bấy lâu nay , ở đây có mọi thứ bạn muốn kể cả cần câu adidas hay cần câu nike.Còn ở coca tôi chả tìm được gì ngoài 1 chai nước ngọt độc hại , hằng con tôi đã phải nâu mắt vì suốt ngày mè nheo đòi nước ngọt với tôi.
                     Một trải nghiệm tuyệt vời , tôi sẽ cho 5 sao còn các bạn thì sao ? Hãy nhanh tay ủng hộ họ để chúng ta đều được trải nghiệm sản phẩm ở đây . Thú thật cần câu ở đây câu rất mát tay , tôi đã câu được tận 5 em ở việt nam hehe."</p>
                <h3>Cristiano Ronaldo</h3>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
        <div class="testimonials-col">
            <img src="images/kiet.jpg">
            <div>
                <p>Trần Anh Kiệt nói:"Cần câu là thứ duy nhất mà bạn nên đầu tư , bởi nếu bạn không đầu tư bạn sẽ chẳng câu được con nào cả ,kể cả con crush của bạn.Đến với cửa hàng này bạn sẽ được trải nghiệm từ
                     cách phục vụ tới sản phẩm ,mọi thứ đều hoàn hảo.Để các bạn thấy sự ảnh hưởng của tiệm đồ câu lớn như thế nào thì tôi sẽ kể cho các bạn nghe "Chuyện là vụ ronaldo quăng chai coca đã có sắp đặt từ trước ,Ronaldo đã nhận cây cần câu shimano special(20tr)
                      để đồng ý việc quăng hai chai coca và bạn đoán xem Coca họ đã mất toi 4 Tỷ đôla.Tôi tiếc là không nhấn được 6 sao cho cửa hàng này,còn nếu có vấn đề gì bạn cứ gọi tới sdt tui để giải quyết,tui cá là bạn sẽ buông chuột và được xem 1 trận solo yasuo mãn nhãn!"</p>
                <h3>CEO:Trần Anh Kiệt</h3>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
            </div>
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