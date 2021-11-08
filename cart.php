   <?php include "inc/header.php"; ?>

<?php 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      $cartId = $_POST['cartId'];
      $quantity = $_POST['quantity'];
      $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);

  }

?>


<?php 

    if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid']; 
        $delcart = $ct->del_product_cart($cartid);
    }


?>



   <section class="header">
      <nav>
        </nav>  
    <!--CART ITEMS DETAIL-->
    <div class="small-container1 cart-page">
        <?php 
            if(isset($update_quantity_cart)){
                echo $update_quantity_cart;
            }
        ?>

        <?php 
            if(isset($delcart)){
                echo $delcart;
            }
        ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        $subtotal = 0;
                        while($result = $get_product_cart->fetch_assoc()){
                ?>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="admin/uploads/<?php echo $result['image'] ?> ">
                        <div>
                            <p><?php echo $result['productName'] ?></p>
                            <small><?php echo $result['price']  ?> VNĐ</small>
                            <br>
                            <a onclick="return confirm('Bạn có muốn xóa Sản Phẩm này không?');" href="?cartid= <?php echo $result['cartId'] ?> ">Xóa Sản Phẩm</a>
                        </div>
                    </div>

                </td>
                <td>
                    <form action ="" method="post">
                    <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
                    <input type="number" name="quantity" min ="1" value="<?php echo $result['quantity'] ?>">
                    <input type="submit" name="submit" Value="Cập Nhật" id="button" />



                    <style>#button{border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 18px;
                                    padding: 0px 5px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: pink;
                                    padding-right: 88px;
                                    padding-bottom: 27px;
                                }
                            
                    </style>
                    
                    
                    </form>

                </td>
                <td><?php   
                        $total = $result['price'] * $result['quantity']; 
                        echo $total;   
                    ?>    
                 VNĐ</td>
            </tr>

         <?php 
                    $subtotal += $total;
                        }
                    }

        ?>

        </table>
        
        <div class="total-price">
            <table>
                <tr>
                    <?php
                    $check_cart = $ct->check_cart();
                            if($check_cart){  
                    ?> 

                    <td>Tổng Tiền</td>

                    <td>       
                        <?php
                            echo $subtotal .' ' .'VNĐ';
                            
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Thuế VAT</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Tổng Giá Tiền</td>
                    <td><?php 
                            
                            $vat = $subtotal * 0.1;
                            $gtotal = $subtotal + $vat;
                            echo $gtotal .' ' .'VNĐ';
                        ?>
                    
                    </td>
                </tr>

        <?php }else 
                {   

                    echo '<div class="alert"><B>Giỏ Hàng của bạn hiện tại không có Sản Phẩm nào.</B></div>';
                }
        ?>
            
            </table>
        </div>

        <a href="index.php" class="hero-btn2">Tiếp tục Mua Sắm</a>
        <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        echo "<a href='payment.php' class='hero-btn2' >Thanh toán Hóa Đơn</a>";
                ?>
        
        <?php 
    
}else{
    
}
        ?>

        </div>

    <nav>
        </nav>  

    </section>

<?php include 'inc/footer.php'; ?>


 