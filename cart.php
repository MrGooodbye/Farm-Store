   <?php include "inc/header.php"; ?>

<?php 
    
    if(isset($_GET['Cartid']) && ($_GET['Quantity'])) {
      $cartId = $_GET['Cartid'];
      $quantity = $_GET['Quantity'];
  }
?>

<?php 

    if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid']; 
        $delcart = $ct->del_product_cart($cartid);
    }
?>

<?php 
    if(isset($delcart))
    {
        echo '<script>window.location="cart.php#giohangf"</script>';
    }
?>

<body>
<a name="giohangf"></a>
<div class="containe" id="container">  
<span id="popup1" class="overlay">
	<div class="popup">
  Số lượng hiện tại không thể lớn hơn số lượng chúng tôi đang bán!
	</div>
</span>
  <div class="cart transition is-open">
    <div class="table" id="table">
      <div class="layout-inline row th">
        <div class="col col-pro">Sản Phẩm</div>
        <div class="col col-price align-center "> 
          Đơn Giá
        </div>
        <div class="col col-qty align-center">Số Lượng</div>
        <div class="col">Tổng Tiền</div>
      </div>
      <br>
    <a name="giohangf" ></a>
    <!--CART ITEMS DETAIL-->
        <?php 
            if(isset($update_quantity_cart)){
                echo $update_quantity_cart;
            }
        ?>
<?php 
        $get_product_cart = $ct->get_product_cart();
        if($get_product_cart){
        $subtotal = 0;
        while($result = mysqli_fetch_assoc($get_product_cart))
        {
            $cartId = $result['cartId']; 
            $product_Id = $result['productId'];
            $sl_hientai = $result['quantity'];
?>
            <div class="layout-inline row">  
            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="kitten" />
            <div class="col col-pro layout-inline">
            <p><?php echo $result['productName']?></p>
            </div>
            <div class="col col-price col-numeric align-center ">
            <p><?php echo $fm->format_currency($result['price'])?></p>
            </div>
            <div class="col col-qty layout-inline">
            <?php echo '<button class="qty qty-minus" id="minus" onclick="minus_sl('.$cartId.',\''.$sl_hientai.'\')">-</button>'; ?>
            <?php echo '<input type="numeric" class="thay_doi" id="soluong" onclick="change_sl('.$cartId.',\''.$product_Id.'\')" value="'.$sl_hientai.'"></input>';?>
            <?php echo '<button class="qty qty-minus" id="plusus" onclick="plus_sl('.$cartId.','.$product_Id.',\''.$sl_hientai.'\')">+</button>'; ?>
            </div>
            <div class="col col-total col-numeric">               
            <?php $total = $result['price'] * $result['quantity'];  ?>
            <p><?php echo $fm->format_currency($total)?></p>
            </div>
            <a onclick="return confirm('Bạn có muốn xóa Sản Phẩm này không?');" href="?cartid= <?php echo $result['cartId'] ?>"><i class="fa-solid fa-trash fa-2x"></i></a>
            </div>
<?php 
            $subtotal += $total;
        }
        
?>  
        <hr>   
        <div class="tf">
          <div class="row layout-inline">
            <div class="col">
            </div>
           <div class="col">   
              <p>Tổng Số Tiền</p>                     
              <p><B><?php echo $fm->format_currency($subtotal)." "."VNĐ"?></B></p>
           </div>
            </div>
        </div>        

  </div>
    <a href="hinhthucthanhtoan.php#center" class="btn btn-thanhtoan">Thanh Toán</a>  
</div>

<?php
        }
        else 
                {   
                    echo "<br>";
                    echo '<center><h4>Giỏ Hàng hiện tại đang trống.</h4></center>';
                }
        ?>
      
</div>
<div>

</div>
</div>            
</div>
</div>
</body>

    <?php include 'inc/footer.php'; ?>


 <style>
    img {
  width: 100px;
  height: 80px;
  float: center;
}

a {
  text-decoration: none;
}

.containe {
  width: 80%;
  margin: 40px auto;  
  overflow: hidden;
  position: relative;
  
  border-radius: 0.6em;
  background: #ecf0f1;
  box-shadow: 0 0.5em 0 rgba(138, 148, 152, 0.2);
}

.heading {
  position: relative;
  z-index: 1;
  color: #f7f7f7;
  background: #f34d35;
}

.cart {
  margin: 25px;
  overflow: hidden;
}

.table {
  background: #ffffff;
  border-radius: 0.6em;
  overflow: hidden;
  clear: both;
  margin-bottom: 1.8em;
}


.layout-inline > * {
  display: inline-block;
}

.align-center {
  text-align: center;
}

.th {
  background: #f34d35;
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 1.5em;
}

.tf {
  background: #fff;
  text-transform: uppercase;
  text-align: right;
  font-size: 1.2em;
}

.tf B{
  color: deeppink;
  font-size: 22px;
  float: left;
}

.row{
    margin-top: 0;
}

.tf p {
  color: black;
  font-weight: bold;
  font-size: 22px;
  float: left;
}

.col {
  padding-top: 25px;
  padding-bottom: 20px;
}

.col-price{
    padding-right: 70px;
}

.col-price p{
    padding-right: 110px;
}

.col-pro p {
  padding-bottom: 0px;
  margin: 0px;
}

.col-qty qty-minus{
    padding-right: 200px; 
}

.layout-inline{
    padding-left: 50px;
}


.col-numeric p {
  font: bold 1.8em helvetica;
}

.col-total p {
  color: #12c8b1;
}

.tf .col {
  width: 20%;
}


.row-bg2 {
  background: #f7f7f7;
}

.visibility-cart {
  position: absolute;
  color: #fff;
  top: 0.5em;
  right: 0.5em;
  font:  bold 2em arial;
  border: 0.16em solid #fff;
  border-radius: 2.5em;
  padding: 0 0.22em 0 0.25em ;
}

.col-qty > * {
  vertical-align: middle; 
}

.col-qty > input {
  max-width: 2.6em;
}


button.qty {
  width: 1em;
  line-height: 42px;
  border-radius: 20px;
  font-size: 2.5em;
  font-weight: bold;
  text-align: center;
  background: #43ace3;  
  color: #fff;
  border: none;
}

a.qty:hover {
  background: #3b9ac6;
}

.btn {
  padding: 10px 30px;
  border-radius: 0.3em;
  font-size: 1.4em;
  font-weight: bold;
  background: #43ace3;
  color: #fff;
  box-shadow: 0 3px 0 rgba(59,154,198, 1)
}

.btn:hover {
  opacity: 0.7;
}

.btn-update {
  float: right;
  margin: 0 0 1.5em 0;
}

.btn-thanhtoan{
  display: flex;
  justify-content: center;
  padding-top: 15px;
  padding-bottom: 15px;
  margin: 0 auto;
  width: 20%;
  border: none;
  border-radius: 15px;
}

.transition {
  transition: all 0.3s ease-in-out;
}

@media screen and ( max-width: 755px) {
  .container {
    width: 98%;
  }
  
  .col-pro {
    width: 35%;
  }
  
  .col-qty {
    width: 22%;
  }
  
  img {
    width: 20px;
    margin-bottom: 1em;
  }
}

@media screen and ( max-width: 591px) {
  
}

.fa-solid{
    padding-top: 35px;
    padding-right: 30px;
}

#popup1{
  margin: 405px auto;
  margin-left: 800px;
  padding: 10px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: absolute;
  border: none;
  border-radius: 15px;
  border-style: solid;
  float: right;
  z-index: -999px;
  font-size: 18px;
  font-family: Tahoma, Arial, sans-serif;
  background-color: #06D85F;
  /* display: none; */
  /* opacity: 0.5; */
}

 </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

 <script>
   $("#popup1").hide();
  function minus_sl(id_cart, sl_hientai)
  {
    // alert(id_cart + ','+ sl_hientai);
    sl_conlai = sl_hientai - 1;
    // alert(sl_conlai);

    if(sl_conlai == 0)
    {
      
    } 
    else
    {
      $.ajax({
        url: 'classes/action.php',
        type: 'POST',
        data: {Id_Cart: id_cart, Sl_Conlai: sl_conlai},
        success: function(data)
        {
          $( "#table" ).load( "http://localhost/gearmaytinh/cart.php" + " #table" );
        },
        error: function(xhr, statusText, error)
        {
          alert(xhr.status);
        }
      });
    }
  }

  function change_sl(cartid, id) 
  {
  //  alert(cartid + ',' + id);
   //không biết vì lý do gì đó mà dùng id của input type number không được nên phải dùng class của input type number.
    $('.thay_doi').on("input", function() 
    {
      var dInput = this.value;
      // alert(dInput);
      // alert(cartid + ',' + id + ',' + dInput);
      if(dInput == 0)
      {
        // alert("Input type number đang = 0!");
      }
      // else if(dInput == this.value)
      // {
         // alert("Input type number mới đang = giá trị cũ!");
      // }
      else
      {
        $.ajax({
          url: 'classes/action.php',
          type: 'POST',
          data: {id_product: id},
          //truyền id sản phẩm để check số lượng đang bán
          success: function(data)
          {
            // alert(data);
            //không biết lý do gì mà so sánh không được nên phải format data type
            var parsedata = parseFloat(data);
            var parsedInput = parseFloat(dInput);
            if(parsedata  >= parsedInput)
            {
              // alert("Số lượng đang bán lớn hơn!");
              $.ajax({
                url: 'classes/action.php',
                type: 'POST',
                data: {GioHang_Id: cartid, SoLuongMoi: dInput},
                success: function()
                {
                  $("#table").load("http://localhost/gearmaytinh/cart.php" + " #table", function()
                  {
                    $(".thay_doi").focus(), function() 
                    {
                      
                      
                    };
                    
                  });
                },
                error: function(xhr, statusText, error)
                {
                  alert(xhr.status);
                }
              })
            }
          },
          error: function(xhr, statusText, error)
          {
            alert(xhr.status);
          }
        });
      }
    })
  }

  function plus_sl(cart_id, product_id, soluong_hientai)
  {
    // alert(cart_id + ',' + product_id + ',' + soluong_hientai);
    //soluong_hientai là kiểu string nên không thể dùng phép + được => phải dùng + ở phía trước nó 
    sl_tanglen = +soluong_hientai + 1;
    // alert(sl_tanglen);
    $.ajax({
      url: 'classes/action.php',
      type: 'POST',
      data: {Product_Id: product_id},
      success: function(data)
      {
       if(data >= sl_tanglen)
       {
        $.ajax({
          url: 'classes/action.php',
          type: 'POST',
          data: {Cart_Id: cart_id, Sl_Tang: sl_tanglen},
          success: function()
          {
            $( "#table" ).load( "http://localhost/gearmaytinh/cart.php" + " #table" );
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
            alert(jqXHR.status);
          }
        });
       }
       else
       {
         $( "#popup1" ).hide().fadeIn(); 
         timer = setTimeout(function () 
         {
          $( "#popup1" ).fadeOut();
         },4000)
        //  var row = $(".overlay").clone(true);
        //  row.insertAfter('#container').hide().fadeIn();
       }
        
      },
      error: function(xhr, statusText, error)
      {
        alert(xhr.status);
      }
    });
  }
  
 </script>