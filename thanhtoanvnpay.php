<?php 
    include "inc/header.php"; 
?>


<?php 
    $login_link = "dangnhap.php";
    $login_check = Session::get('customer_login');
    if($login_check == false)
        {
            echo "<script> location.replace('" . $login_link . "')  </script>";
        }    

        if(isset($_GET['Cartid']) && ($_GET['Quantity'])) {
            $cartId = $_GET['Cartid'];
            $quantity = $_GET['Quantity'];
            $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
        }
?>

<?php 

    if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid']; 
        $delcart = $ct->del_product_cart($cartid);
    }

    if(isset($delcart))
    {
        echo '<script>window.location="thanhtoanvnpay.php#dathang"</script>';
    }
?>


<a name = "dathang"></a>
<div class="containe">  
  <div class="cart transition is-open">
    <div class="table">
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
        if($get_product_cart)
        {
        $subtotal = 0;
        while($result = mysqli_fetch_array($get_product_cart))
        {
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
            <a href="?Cartid=<?php echo $result['cartId'] ?>&Quantity=<?php echo $result['quantity']-1?>" class="qty qty-minus">-</a>
                <input type="numeric" value="<?php echo $result['quantity']?>" />
            <a href="?Cartid=<?php echo $result['cartId'] ?>&Quantity=<?php echo $result['quantity']+1?>" class="qty qty-plus">+</a>
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
  </div>
        <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart)
                    {
                        while($result = $get_product_cart->fetch_assoc())
                        {
                ?>

                <form action ="vnpay_create_payment.php" method = "post">
                    <input type ="hidden" name ='order_id' value = "<?php echo $result['code_cart_online']?>"> 
                    <input type ="hidden" name ='total_price' value = "<?php echo $subtotal?>"> 
<?php 
                        }
?>
                    
                    <button type="submit" class='btn btn-thanhtoan' name ='redirect'>Thanh Toán VNPAY</button>
                </form>
                        
<?php 
                    }
                    
                    else{}
?>
        </div>
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


a.qty {
  width: 1em;
  line-height: 1em;
  border-radius: 2em;
  font-size: 2.5em;
  font-weight: bold;
  text-align: center;
  background: #43ace3;  
  color: #fff;
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
  box-shadow: 0 3px 0 rgba(59,154,198, 1);
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
  margin: 0 auto;
  width: 25%;
  border: none;
  border-radius: 15px;
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
 </style>