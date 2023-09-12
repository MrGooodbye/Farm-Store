<?php include "inc/header.php"; ?>

<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['muangaykhongsale']))
    {
        $masp = $_POST['masp'];
        $quantity = 1;
        $muangay_redirect = $ct->add_to_cartt($quantity, $masp);
        // echo '<script>alert("'.$masp.'")</script>';
        if($muangay_redirect)
        {
            echo "<script>window.location = 'cart.php#giohangf'</script>";
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['muangaycosale']))
    {
        $masp = $_POST['masp'];
        $quantity = 1;
        $muangay_redirect = $ct->add_to_cartt($quantity, $masp);
        // echo '<script>alert("'.$masp.'")</script>';
        if($muangay_redirect)
        {
            echo "<script>window.location = 'cart.php#giohangf'</script>";
        }
    }
?>

<?php
if(!isset($_GET['proid_cartplus']) || $_GET['proid_cartplus']==NULL)
{}
else
{
    $id = $_GET['proid_cartplus'];
    $quantity = 1;
    $AddtoCartt = $ct->add_to_cart($quantity, $id);
    if($AddtoCartt)
    {
        echo "<script>window.location = 'index.php#feature_product'</script>";
    }
}
?>


        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">
        <link href="lib/slick/style_index.css" rel="stylesheet">

    <body>  
        <!-- Main Slider Start -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <h6 style="padding-left: 10px"><B>Danh mục sản phẩm</B></h6>
                                <li class="nav-item">
<?php 
                                $getall_category = $cat->show_category_fontend(); 
                                if($getall_category)
                                {
                                    while($result_allcat = $getall_category->fetch_assoc())
                                    {
                                        echo '<a class="nav-link" href="productbycat.php?catid='.$result_allcat['catId'].'"><i class="fa-solid fa-tag"></i>'.$result_allcat['catName'].'</a>';
                                    }
                                }
?>                                    
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <div class="header-slider normal-slider">
                        <div class="header-slider-item">
                                <img src="images/Newfolder/banner1.jpg" alt="Slider Image" />
                            </div>
                            <div class="header-slider-item">
                                <img src="images/Newfolder/banner2.jpg" alt="Slider Image" />
                            </div>
                            <div class="header-slider-item">
                                <img src="images/Newfolder/banner3.jpg" alt="Slider Image" />
                            </div>
                            <div class="header-slider-item">
                                <img src="images/Newfolder/banner4.jpg" alt="Slider Image" />
                            </div>
                            <div class="header-slider-item">
                                <img src="images/Newfolder/banner5.jpg" alt="Slider Image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="header-img">
                            <div class="img-item">
                                <img src="images/Newfolder/Chi-15m2-cua-hang-nong-san-khong-thuoc-tru-sau-lam-nhut-mat-khach-hang-cua-hang-sach-anh-1524450590-width620height465.jpg" alt="Slider Image" />
                                <a class="img-text" href="">
                                    <p>Chi nhánh tại Hà Nội</p>
                                </a>
                            </div>
                            <div class="img-item">
                                <img src="images/Newfolder/song-sach-tai-nong-san-nha-que-co-so-1.jpg" alt="Slider Image" />
                                <a class="img-text" href="">
                                    <p>Chi nhánh tại Hồ Chí Minh</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Slider End -->      
        
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item" style="padding-top: 14px;"><img src="images/Newfolder/logo1.jpg" alt=""></div>
                    <div class="brand-item"><img src="images/Newfolder/logo2.jpg" alt=""></div>
                    <div class="brand-item"><img src="images/Newfolder/logo3.jpg" alt=""></div>
                    <div class="brand-item"><img src="images/Newfolder/logo4.jpg" alt=""></div>
                    <div class="brand-item"><img src="images/Newfolder/logo5.jpg" alt=""></div>
                    <div class="brand-item"><img src="images/Newfolder/logo6.png" alt=""></div>
     
                </div>
            </div>
        </div>     
        
        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2 style="font-size: 17.7px;">Bảo Mật Thông Tin Thanh Toán</h2>
                            <p style="font-size: 12.27px;">
                                Mọi thông tin giao dịch, thanh toán bằng hình thức online của khách hàng sẽ được bảo mật.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa-solid fa-shield-halved"></i>
                            <h2 style="font-size: 17.7px;">Bảo Mật Thông Tin Khách Hàng </h2>
                            <p>
                                Mọi thông tin cá nhân của khách hàng đều được bảo mật.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Giao Hàng Toàn Quốc</h2>
                            <p>
                                Giao hàng trên 63 tỉnh thành của Việt Nam.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>Hỗ trợ 24/24</h2>
                            <p>
                                Khách hàng sẽ được hỗ trợ thông qua chatbot.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->       
        
        <!-- Call to Action Start -->
        <div class="call-to-action">
            <div class="container-fluid">
                <div class="row align-items-center" style="margin-top: -7px;">
                    <div class="col-md-6">
                        <h1>Gọi cho chúng tôi nếu bạn cần tư vấn</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="tel:0969966996">096 996 69 96</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->       
        
        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <a name="feature_product"></a>
                <div class="section-header">
                    <h1>Sản Phẩm Nổi Bật</h1>
                </div>
                <div class="row align-items-center product-slider product-slider-4">
<?php
                    $product_featured = $product->getproduct_featured();
                    if($product_featured) {
                    while ($result = $product_featured->fetch_assoc()){
                        $sale = $result['sale'];
                        $soluong = $result['solg_from_storage']
?>  
                    <div class="col-lg-3">                      
                        <div class="product-item">
                            <div class="product-title">
                                <a href="chitietsp.php ?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    <img src="admin/uploads/xuatkho/<?php echo $result['image'] ?>" alt="Product Image">
                                </a>
                                <div class="product-action">
<?php 
                                    if($soluong > 0)
                                    {
                                        echo '<a href="?proid_cartplus='.$result['productId'].'"><i class="fa fa-cart-plus"></i></a>';
                                        echo '<a href="chitietsp.php?proid='.$result['productId'].'"><i class="fa fa-search"></i></a>';
                                    }
                                    else
                                    {
                                        echo '<a style="cursor:not-allowed;"><i class="fa fa-cart-plus"></i></a>';
                                        echo '<a href="chitietsp.php?proid='.$result['productId'].'"><i class="fa fa-search"></i></a>';
                                    }
?>
                                </div>
                            </div>
                            <div class="product-price">
<?php                                
                                if($sale == 0)
                                {
                                    if($soluong > 0)
                                    {
                                        echo '<h3><span></span>'.$fm->format_currency($result['price']).'</h3>';
                                        // echo '<a class="btn" href=""  name="submitt"><i class="fa fa-shopping-cart"></i>Mua Ngay</a>';
?>                                        
                                        <form action="" method="post" id="muaban">
                                            <input type="hidden" name="masp" value="<?php echo $result['productId']?>">
                                            <button type="submit" class="btn" name="muangaykhongsale">Mua Ngay</button>
                                        </form>
<?php                                        
                                    }
                                    else
                                    {
                                        echo '<h3 style="color: red;">Hết hàng<span></span></h3>';
                                    }   
                                }
                                else
                                {
                                    if($soluong > 0)
                                    {
                                        echo '<h3><del style="font-size: 17px;">'.$fm->format_currency($result['price']).'</del><span></span></h3>';
                                        echo '<div class="rate_sale" style="padding-top: 5px; left: -178px; padding-bottom: 5px; position: relative; color: white; border-radius: 10px; 
                                        border-style: solid; background-color: green; width: 13%; text-align: center; font-family: Times New Roman; 
                                        font-size: 12px; float: right";> -'.$result['sale'].'%</div>';
                                        echo '<br>';
                                        $giaKM = $result['price'] - ($result['price'] * $sale / 100);
                                        echo '<h3><span></span>'.$fm->format_currency($giaKM).'</h3>';
?>                                        
                                        <form action="" method="post" id="muaban">
                                            <input type="hidden" name="masp" value="<?php echo $result['productId']?>">
                                            <button type="submit" class="btn" name="muangaycosale">Mua Ngay</button>
                                        </form>
<?php
                                    }
                                    else
                                    {
                                        echo '<h3 style="color: red;">Hết hàng<span></span></h3>';
                                    }    
                                }
?>
                            </div>
                        </div>                                   
                    </div>
                    <?php }}?>
                </div>
            </div>
        </div>
        <!-- Featured Product End -->  
        
        <!-- Review Start -->
        <div class="review">
            <div class="container-fluid">
                <div class="row align-items-center review-slider normal-slider">
                    <div class="col-md-6">
                        <div class="review-slider-item">
                            <div class="review-img">
                                <img src="img/review-1.jpg" alt="Image">
                            </div>
                            <div class="review-text">
                                <h2>Người Dùng 1</h2>
                                <h3>Người Dùng</h3>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p>
                                    Tốt.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="review-slider-item">
                            <div class="review-img">
                                <img src="img/review-2.jpg" alt="Image">
                            </div>
                            <div class="review-text">
                                <h2>Người Dùng 2</h2>
                                <h3>Người Dùng</h3>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p>
                                    Tạm được.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="review-slider-item">
                            <div class="review-img">
                                <img src="img/review-3.jpg" alt="Image">
                            </div>
                            <div class="review-text">
                                <h2>Người Dùng 3</h2>
                                <h3>Người Dùng</h3>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                </div>
                                <p>
                                    Tệ.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Review End -->   
        
    
        <?php include 'inc/footer.php'; ?>

        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

