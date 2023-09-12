<?php include_once "inc/header.php"; ?>

    <a name="sanpham"></a>


<?php 
if(!isset($_GET['timkiem']))
{      
?>
<!--Danh sách sản phẩm Đồ câu-->
<div class="small-container" >

    <div class="row1 row-2" >
        <h2>Sản Phẩm</h2>
        <select onchange="location = this.value">
        <option selected="selected">Tất Cả Loại</option>
            <?php 
                $get_all_category = $cat->show_category_fontend();
                if($get_all_category){
                    while($result_all_cat = $get_all_category->fetch_assoc())
                    {
            ?>
            <option value="productbycat.php?catid=<?php echo $result_all_cat['catId']?>#sanphamtheoloai"> <?php echo $result_all_cat['catName'] ?></option>
            <?php
                    }
                }
            ?>
        </select>
    </div>

    <div class="container1">
        <form id="lets_search" action="sanpham.php#sanpham" method="get" class="thanhtim" name="Form">
        <input type="search" placeholder="Tìm theo tên sản phẩm" name="timkiem" id="str" >
        <button type="submit"  id="submitt">  <i class="fa fa-search"></i> </button>
        </form>
    </div>
   
    <div class="row1">
<?php 

            $getallproduct = $product->getallproduct();
            if($getallproduct) 
            {
                while ($result = $getallproduct->fetch_assoc())
                {
        ?>
                    <div class="col-4">
<?php 
                    if($result['sale'] == 0)
                    {

                    }
                    else
                    {
                        echo '<div class="rate_sale" style="padding-top: 5px; padding-bottom: 5px; position: static; color: white; border-radius: 10px; 
                        border-style: solid; background-color: red; width: 13%; text-align: center; font-family: Times New Roman; 
                        font-size: 17.5px; margin-bottom: 8px;"> -'.$result['sale'].'%</div>';
                    }
?>
                    <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>#chitietsanpham"><img src="admin/uploads/xuatkho/<?php echo $result['image'] ?> " id="popcornmakers"></a>
                    <h4><?php echo $result['productName']?></h4>
                    
<?php 
                    if($result['sale'] == 0)
                    {
                        echo '<br>';
                        echo '<B style="color:MediumVioletRed;">Giá: '.$fm->format_currency($result['price']).' VND</B>';	
                    }
                    else
                    {
                        echo '<br>';
                        $giagoc = $result['price'];
						$giatriKM = $result['sale'];
						$giaKM =  $giagoc - ($giagoc * $giatriKM / 100);						
						echo '<del>Giá gốc: '.$fm->format_currency($result['price']).' VND</del>';	
                        
                       

                        echo '<br>';
                        echo '<B style="color:DeepPink;">Giá khuyến mãi: '.$fm->format_currency($giaKM).' VND</B>';		
                    }
?>
                    
                    <p>Tình trạng: 
                    <?php 
                        if($result['solg_from_storage'] <= 0)
                        {echo "<font color=\"red\">Hết Hàng</font>";}
                        else{echo "<font color=\"blue\">Còn Hàng</font>";}
                    ?>
                    </p>
                    </div>
        <?php
                }
            }
        ?>
    </div>

<?php
}
else
{
    $tukhoa = $_GET['timkiem'];
    // echo $tukhoa;

?>  

    <div class="row1 row-2" >
        <h4>Tìm Sản Phẩm Theo Từ Khoá: <?php echo $tukhoa?></h4>
        <select onchange="location = this.value">
        <option selected="selected">Tất Cả Loại</option>
            <?php 
                $get_all_category = $cat->show_category_fontend();
                if($get_all_category){
                    while($result_all_cat = $get_all_category->fetch_assoc())
                    {
            ?>
            <option value="productbycat.php?catid=<?php echo $result_all_cat['catId']?>#sanphamtheoloai"> <?php echo $result_all_cat['catName'] ?></option>
            <?php
                    }
                }
            ?>
        </select>
    </div>

    <div class="container1">
        <form id="lets_search" action="sanpham.php#sanpham" method="get" class="thanhtim" name="Form">
        <input type="text" placeholder="Tìm theo tên sản phẩm" name="timkiem" id="str" >
        <button type="submit" id="submitt" onclick="myFunction()">  <i class="fa fa-search"></i> </button>
        </form>    
    </div>

    <div class="row1">

<?php

    $timkiemsanpham = $product->searchproduct($tukhoa);
    if($timkiemsanpham)
    {
        while ($result = $timkiemsanpham->fetch_assoc())
        {
            
?>
            <div class="col-4">
            <?php 
                    if($result['sale'] == 0)
                    {

                    }
                    else
                    {
                        echo '<div class="rate_sale" style="padding-top: 5px; padding-bottom: 5px; position: static; color: white; border-radius: 10px; 
                        border-style: solid; background-color: red; width: 13%; text-align: center; font-family: Times New Roman; 
                        font-size: 17.5px; margin-bottom: 8px;"> -'.$result['sale'].'%</div>';
                    }
?>
                    <a href="chitietsp.php?proid=<?php echo $result['productId'] ?>#chitietsanpham"><img src="admin/uploads/xuatkho/<?php echo $result['image'] ?> " id="popcornmakers"></a>
                    <h4><?php echo $result['productName']?></h4>
                    
<?php 
                    if($result['sale'] == 0)
                    {
                        echo '<br>';
                        echo '<B style="color:MediumVioletRed;">Giá: '.$fm->format_currency($result['price']).' VND</B>';	
                    }
                    else
                    {
                        echo '<br>';
                        $giagoc = $result['price'];
						$giatriKM = $result['sale'];
						$giaKM =  $giagoc - ($giagoc * $giatriKM / 100);						
						echo '<del>Giá gốc: '.$fm->format_currency($result['price']).' VND</del>';	
                        
                       

                        echo '<br>';
                        echo '<B style="color:DeepPink;">Giá khuyến mãi: '.$fm->format_currency($giaKM).' VND</B>';		
                    }
?>
                    
                    <p>Tình trạng: 
                    <?php 
                        if($result['solg_from_storage'] <= 0)
                        {echo "<font color=\"red\">Hết Hàng</font>";}
                        else{echo "<font color=\"blue\">Còn Hàng</font>";}
                    ?>
                    </p>
            </div>
<?php 
        }
    }
    else
    {
        echo "<center><br>Sản phẩm bạn tìm hiện tại không có. Vui lòng quay lại sau!</center>";
    }
}   
?>  
    </div>
    <br>
</div>

<style>#popcornmakers {width: 315px;}
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