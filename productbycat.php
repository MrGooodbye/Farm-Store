<?php include "inc/header.php"; ?>


<?php 
    if(!isset($_GET['catid']) || $_GET['catid']==NULL)
    {
        echo "<script>window.location = '404.php'</script>";
    }

    elseif(!isset($_GET['timkiem']) || $_GET['timkiem']==NULL)
    {   
        $id = $_GET['catid'];  
?>
                <a name="sanphamtheoloai"></a>
                <!--Danh sách sản phẩm Cần Câu-->
                <div class="small-container">
                <div class="row1 row-2">
<?php 
                $name_catt = $cat->get_name_by_cat($id);
                if($name_catt)
                {
                    $result_namee = $name_catt->fetch_assoc();
                    {
?>
                        <h2>Loại Sản Phẩm: <?php echo $result_namee['catName']?></h2>
                        <select onchange="location = this.value"> 
                        <option selected = ""><?php echo $result_namee['catName']?></option>
                        <option value="sanpham.php#sanpham">Tất cả Loại</option>
<?php         
                        $get_all_category_notselected = $cat->show_category_notselected($id);
                        if($get_all_category_notselected)
                        {  
                            while($result_all_cat = $get_all_category_notselected->fetch_assoc())
                            {
?>
                                <option value="productbycat.php?catid=<?php echo $result_all_cat['catId'] ?>#sanphamtheoloai"><?php echo $result_all_cat['catName'] ?></option>                 
<?php 
                            }
                        }
                    }
                }
                    //khi chọn sp theo loại mà hiện tại loại đó chưa có sẵn sản phẩm nào thì echo ra thanh select để tiện chọn lại
                else
                {    
                    $get1category = $cat->show_1category($id);
                    if($get1category)
                    {
                        $result_1cate = $get1category->fetch_assoc();
?>
                        <h2>Loại Sản Phẩm: <?php echo $result_1cate ['catName'] ?></h2>
                        <select onchange="location = this.value"> 
                        <option selected = ""><?php echo $result_1cate['catName']?></option>
                        <option value="sanpham.php#sanpham">Tất cả Loại</option>
<?php
                        $get_all_category_notselected = $cat->show_category_notselected($id);
                        if($get_all_category_notselected)
                        {
                            while($result_all_cat = $get_all_category_notselected->fetch_assoc())
                            {
?>
                                <option value="productbycat.php?catid=<?php echo $result_all_cat['catId'] ?>#sanphamtheoloai"><?php echo $result_all_cat['catName'] ?></option> -->
<?php
                            }
                        }
                    }
                }
?>
                        </select>   
            </div>
            
<?php             
    $name_cat = $cat->get_name_by_cat($id);
    if($name_cat)
        {
            $result_name = $name_cat->fetch_assoc();
            {
?>        
            <h2 class="title">Sản Phẩm <?php echo $result_name['catName'] ?></h2>
            <div class="container1">
            <!-- http_build_query() -->
                <form id="lets_search" action= "productbycat.php#sanphamtheoloai" method="get" class="thanhtim" name="Form">
                <input type="text" placeholder="Tìm theo loại sản phẩm" name="timkiem" id="str" >
                <input type="hidden" value="<?php echo $id ?>" name="catid" >
                <button type="submit" id="submitt" onclick="myFunction()">  <i class="fa fa-search"></i> </button>
                </form>    
            </div>
            </div>
<?php 
            }
        }
?>            

    <div class="row1">
<?php 
    $productbycat = $cat->get_product_by_cat($id);
    if($productbycat)
    {
        while($result = $productbycat->fetch_assoc())
        {
?>
            <div class="col-4">
                <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>#chitietsanpham"><img src="admin/uploads/<?php echo $result['image'] ?> " id="popcornmakers"></a>
                <h4><?php echo $result['productName'] ?></h4>
                <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <p>Giá: <?php echo $result['price'] ?> VNĐ</p>
            </div> 
    </div>
<?php 
        }
    }
    else
    {
        echo "Danh mục bạn chọn hiện tại không có Sản Phẩm nào. Vui lòng quay lại sau!";
    }
?>
    </div>
</div>        
        <!--Tạo link truy cập danh sách sản phẩm-->
</br>
</br>
</div>
<?php 
}
       
    
    
//kết thúc trường hợp khi không lấy được $_GET['timkiem']


    else if(isset($_GET['timkiem']) || $_GET['timkiem']!=NULL)
    {
        $timtheoloai = $_GET['timkiem'];
        $id = $_GET['catid'];  
?>
        <a name="sanphamtheoloai"></a>

        <!--Danh sách sản phẩm Cần Câu-->
        <div class="small-container">
        <div class="row1 row-2">
<?php 
        $name_catt = $cat->get_name_by_cat($id);
        if($name_catt)
        {
            $result_namee = $name_catt->fetch_assoc();
            {
?>
                <h2>Tìm theo loại sản phẩm: <?php echo $timtheoloai?></h2>
                <select onchange="location = this.value"> 
                <option selected = ""><?php echo $result_namee['catName']?></option>
                <option value="sanpham.php#sanpham">Tất cả Loại</option>
<?php 

                $get_all_category_notselected = $cat->show_category_notselected($id);
                if($get_all_category_notselected)
                {
                    while($result_all_cat = $get_all_category_notselected->fetch_assoc())
                    {
?>
                        <option value="productbycat.php?catid=<?php echo $result_all_cat['catId'] ?>#sanphamtheoloai"><?php echo $result_all_cat['catName'] ?></option>
<?php 
                    }
                }
            }
        }

        else
        {    
            $get1category = $cat->show_1category($id);
            if($get1category)
            {
                $result_1cate = $get1category->fetch_assoc();
?>
                <h2>Loại Sản Phẩm:</h2>
                <select onchange="location = this.value"> 
                <option selected = ""><?php echo $result_1cate['catName']?></option>
                <option value="sanpham.php#sanpham">Tất cả Loại</option>
<?php
                $get_all_category_notselected = $cat->show_category_notselected($id);
                if($get_all_category_notselected)
                {
                    while($result_all_cat = $get_all_category_notselected->fetch_assoc())
                    {
?>
                        <option value="productbycat.php?catid=<?php echo $result_all_cat['catId'] ?>#sanphamtheoloai"><?php echo $result_all_cat['catName'] ?></option> -->
<?php
                    }
                }
            }
        }
?>
                </select>   
        </div>

<?php 
    $name_cat = $cat->get_name_by_cat($id);
    if($name_cat)
    {
        $result_name = $name_cat->fetch_assoc();
        {
?>        
            <h2 class="title">Sản Phẩm <?php echo $result_name['catName'] ?></h2>
            <div class="container1">
                <!-- http_build_query() -->
                <form id="lets_search" action= "productbycat.php#sanphamtheoloai" method="get" class="thanhtim" name="Form">
                <input type="text" placeholder="Tìm theo loại sản phẩm" name="timkiem" id="str" >
                <input type="hidden" value="<?php echo $id ?>" name="catid" >
                <button type="submit" id="submitt" onclick="myFunction()">  <i class="fa fa-search"></i> </button>
                </form>    
            </div>
            </div>
<?php 
        }
    }
?>

<div class="row1">
<?php 
    $searchtheoloai = $product->searchbycatproduct($id,$timtheoloai);
    if($searchtheoloai)
    {
        while($result = $searchtheoloai->fetch_assoc())
        {
?>
            <div class="col-4">
                <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>#chitietsanpham"><img src="admin/uploads/<?php echo $result['image'] ?> " id="popcornmakers"></a>
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
    }
    else
    {
        echo "Danh mục bạn chọn hiện tại không có Sản Phẩm nào. Vui lòng quay lại sau!";
    }
?>

        <!--Tạo link truy cập danh sách sản phẩm-->
</br>
</br>
</div>

<?php
    }
?>



<style>
#popcornmakers {width: 250px;}

.container1{
    display: flex;
    align-items: center;
    justify-content: center;
    
}

.thanhtim{
    width: 100%;
    max-width: 600px;
    border-style: solid;
    border-color: LightSkyBlue;
    display: flex;
    align-items: center;
    border-radius: 60px;
    padding: 6px 20px;
    justify-content: center;
}

.thanhtim input{
    flex: 1;
    border: 0;
    outline: none;
}

::placeholder {
   text-align: center; 
}

input{
   text-align:center;
}

#lets_search button{
  color: black;
  font-size: 17px;
  background: #fff;
  border-left: none; /* Prevent double borders */
  border-right: none;
  border-top: none;
  border-bottom: none;

  cursor: pointer;
}

</style>

<?php include 'inc/footer.php'; ?>

<script type="text/javascript">

    if(document.getElementById('str').value.length == 0)
    {
        document.getElementById("submitt").disabled = true;
    }
    
    document.getElementById('str').addEventListener("keypress", myFunction);
    function myFunction() 
    {
        document.getElementById("submitt").disabled = false;
    }
</script>