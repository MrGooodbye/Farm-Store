<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php $storage = new storage(); ?>

<?php  
    if(!isset($_GET['id_sp_storage']) || $_GET['id_sp_storage']==NULL)
    {
        echo '<script>window.location="productstoragelist.php"</script>';
    }
    else
    {
        $id_pd_storage = $_GET['id_sp_storage'];
        $pd_storage_name = $storage->show_pd_storage($id_pd_storage);
    }
?>

<?php    
  $pd = new product();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      
      $insertProduct = $pd->insert_product($_POST,$_FILES, $id_pd_storage); //dùng $_FILES để chèn thêm hình ảnh
  }  
?>

<link rel="stylesheet" type="text/css" href="css/layout.css" />


 <style>table.form input[type="text"] {
                                    font-size: 16px;
                                    border-bottom: 1px solid #b3b3b3;
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;
                                    padding-right: 50px;
                                }</style>

<style>table.form label {padding-right: 20px} </style>
<style>#grid_10 .h2 {padding-right: 360px}</style>



 <style>table.form input[type="submit"] {
                                    border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 18px;
                                    padding: 2px 10px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: aquamarine;

                                }</style>

<style>table.form input[type="file"]{border-bottom: 1px solid #b3b3b3;
                                    
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;}</style>



<style>.tinymce {border-bottom: 1px solid #b3b3b3;
                                    padding: 0px 200px 100px 0px; /*top right bottom left*/
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;}
                                </style>

<style>#select {border-right: 1px solid #b3b3b3;
                border-left: 1px solid #b3b3b3;
                border-top: 1px solid #b3b3b3;
                border-bottom: 1px solid #b3b3b3;
                }

                .col-xs-3{
  margin-left: -45px;
}
#message{
    color: green;
    font-weight: bold;
}

#messageforquantity{
    color: green;
    font-weight: bold;
}

#messagequantity{
    color: green;
    font-weight: bold;
}

#submit{
    border: dashed 1px #333;
    border-radius: 20px;
}
img{
    max-width: 25%;
}                                            
</style>


<div class="grid_10">
    <div class="box round first grid" id="table">
        <center><h2>Xuất Sản Phẩm</h2></center>
        </br>
        </br>
        <div class="block">           
         <form method="post" enctype="multipart/form-data" id="myform" name="Form">
            <table class="form">    
                <tr>
<?php                     
                    if($pd_storage_name)
                    {
                        while($result = $pd_storage_name->fetch_assoc()){
?>                  
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Tên Sản Phẩm" class="medium" id="nameProduct" value="<?php echo $result['productName']?>" readonly/>
<?php }} ?>                          
                        <div id="message"></div>
                        <div id="messageforquantity"></div>
                    </td>                  
                </tr>
               
				<tr>
                    <td>
                        <label>Loại Sản Phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>

                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                            
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 5px;">
                        <label>Mô Tả</label>
                    </td>
                    <td>
                        <textarea id="product_desc" name="product_desc" class="tinymce"></textarea>
                    </td>
                 </tr>
				<tr>
                    <td>
                        <label>Giá Bán</label>
                    </td>
                    <td>
                        <input type="text" id="price" name="price" placeholder="Giá Bán" class="medium" onkeyup="formatNumber(this);" />
                        <span class="col-xs-3"><B>VNĐ</B><span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số Lượng Lấy Ra Bán</label>
                    </td>
                    <td>
                        <input type="text" name="quantity" id="quantity" placeholder="Số Lượng" class="medium"/>
                        <div id="messagequantity"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ảnh Sản Phẩm</label>
                    </td>
                    <td>
                        <div id="imagee" name ="image" width="1px"></div>
                        <input type="file" name="image" id="chonanh" placeholder="Chưa có ảnh được chọn" class="medium"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Danh Mục</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option></option>
                            <option value="1">Đặc Trưng</option>
                            <option value="0">Không Đặc Trưng</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                         </br>
                        <input type="submit" name="submit" Value="Xuất Sản Phẩm" />
                    </td>
                </tr>
            </table>
            
        </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">

    document.getElementById("myform").addEventListener("submit",function(e)
    {
        // var a = document.forms["Form"]["quantity"].value;
        var a = $("#chonanh")[0].files.length;
        var price = document.getElementById('price').value;
        var quantity = document.getElementById('quantity').value;

        if(a == 0)
        {
            e.preventDefault();
            alert("Bạn chưa chọn hình ảnh cho sản phẩm!");
        }
        else if(price === '0')
        {
            e.preventDefault();
            alert('Giá của sản phẩm phải lớn hơn 0!');
        }
        else if(quantity === '0')
        {
            e.preventDefault();
            alert('Số lượng xuất ra bán phải lớn hơn 0!');
        }
    })


    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });

    function formatNumber(a) 
    {
        // format number 1000000 to 1,234,567
        a.value = a.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>

<script>
    //add thằng này thì mới dùng được js
    $(document).ready(function(){
        var name = $("#nameProduct").val();
            var soluonghientai = null;
            $.ajax({
                url: '../classes/action.php',
                type: 'POST',
                data:{ nameProduct: name },
                success: function(data, status)
                {
                    if(data == 0)
                    {
                        alert("Sản Phẩm này không có trong Kho!");
                    }
                    else
                    {
                        // alert(data);  
                        $("#message").html(data.Productname);
                        $("#messageforquantity").html(data.Quantity);
                        $("#message").prepend("Bạn đang lấy ra Sản Phẩm: ");
                        $("#messageforquantity").prepend("Số Lượng trong Kho: ");
                        $("#select").val(data.CatId);
                        $('#id_pd_storage').val(data.Id);
                        // $('#imagee').append("<img src='uploads/"+data.Image+"'/>");

                        $('#nameProduct').keydown(function(){
                            var key = event.keyCode || event.charCode;
                            if( key == 8 || key == 46 )
                            {
                                window.location.reload(this);
                            }
                        
                        });
                        
                        soluonghientai = data.Quantity;
                        if(soluonghientai == 0)
                        {
                            alert('Số Lượng Sản Phẩm này trong Kho đã hết! Vui lòng nhập thêm Hàng vào kho!')
                        }

                        $("#quantity").keyup(function()
                        {
                            var soluonglayra = $("#quantity").val();
                            var soluongconlai = soluonghientai - soluonglayra;
                            $("#messagequantity").html(soluongconlai);
                            $("#messagequantity").prepend("Số Lượng còn lại trong kho sau khi lấy: ");
                            $("#messagequantity").show();
                            if(soluongconlai < 0)
                            {
                                $('#quantity').val("");
                                alert('Số Lượng Sản Phẩm lấy ra bán không thể lớn hơn Số Lượng Sản Phẩm trong kho!')
                                $("#messagequantity").hide();
                            }
                        });
                    }
                },
                error: function(data)
                {
                    console.log("error");
                    console.log(data);
                }
            });
    })

        
    $("#quantity").on('keydown',function(e){
        if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode === 8) 
        {

        }
        else if(e.keyCode === 32 || e.keyCode === 46 || e.keyCode === 189)
        {
            return false;
            //alert("Số lượng lấy ra bán phải lớn hơn 0!");
        }
        else
        {
            return false
        }
    })
            
</script>
<!-- Load TinyMCE -->