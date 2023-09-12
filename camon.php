<?php include 'inc/header.php'; ?>
<?php 
    if(!isset($_SESSION['code_cart'])) 
    {
        echo '<script>window.location = "404.php"</script>';
        // echo $_SESSION['code_cart'];
    }
    else
    {
        $customer_id = Session::get('customer_id');
        // echo $customer_id;
    }
?>

<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))
    {
        if(isset($_SESSION['code_cart']))
        {
            $hoten = $_POST['hoten'];
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            $paid_type = $_POST['paid_type'];
            $insert_cart_online = $ctonline -> insert_cart_online_details($hoten, $sdt, $diachi, $paid_type, $customer_id);
        }
    }
?>

<body>
<?php 
    //VNPAY
    if(isset($_GET['vnp_BankTranNo']))
    {
        $amount = $_GET['vnp_Amount']; 
        $bankcode = $_GET['vnp_BankCode']; 
        $banktranno = $_GET['vnp_BankTranNo']; 
        $cardtype = $_GET['vnp_CardType']; 
        $orderinfo = $_GET['vnp_OrderInfo']; 
        $paydate = $_GET['vnp_PayDate']; 
        //thiếu responecode 
        $tmncode = $_GET['vnp_TmnCode']; 
        $transacno = $_GET['vnp_TransactionNo']; 
        $transactionstatus = $_GET['vnp_TransactionStatus']; 
        $txnref = $_GET['vnp_TxnRef']; 

        if($banktranno != 0)
        {
?>
            <br>
            <center><h2>Thanh Toán Thành Công! Vui lòng để lại thông tin liên hệ</h2></center>
            <hr>
            <div class="small-container">
            <form action="" method="post">
                <label>Họ và Tên</label>
                <input type="text" name="hoten" autofocus></input>
                <label>Số Điện Thoại</label>
                <input type="text" name="sdt"></input>
                <label>Địa Chỉ Giao</label>
                <input type="text" name="diachi"></input>        
                <input type="hidden" name="paid_type" value="VNPAY"></input> 
                <input type="submit" name="submit" class="btn" value="Đặt Hàng"></input>
            </form>
            <br>
            </div>
<?php   
        }
        elseif($banktranno == 0)
        {
            echo '1';
        }
    }

    //MOMO
    elseif(isset($_GET['orderInfo']))
    {
        $message = $_GET['orderInfo'];
        $status = $_GET['message'];
        if($status == 'Successful.')
        {
            ?>
            <br>
            <center><h2>Thanh Toán Thành Công! Vui lòng để lại thông tin liên hệ</h2></center>
            <hr>
            <div class="small-container">
            <form action="" method="post">
                <label>Họ và Tên</label>
                <input type="text" name="hoten" autofocus></input>
                <label>Số Điện Thoại</label>
                <input type="text" name="sdt"></input>
                <label>Địa Chỉ Giao</label>
                <input type="text" name="diachi"></input>        
                <input type="hidden" name="paid_type" value="MOMO"></input> 
                <input type="submit" name="submit" class="btn" value="Đặt Hàng"></input>
            </form>
            <br>
            </div>
<?php   
        }
    }

    else
    {
        
?>
        <div class="small-container" >
        <br>
        <center><h2>Bạn đã huỷ thanh toán</h2></center>
        <br>
        </div>
<?php 
    }
?>

</body>
    
<?php include 'inc/footer.php'; ?>

<style>
    body{
        width: 100%;
    }

    .small-container{
        /*căn giữa*/
        width: 430px;
    }


    .small-container label{
        padding-right: 7px;
    }

    .small-container input[type=text]{
        width: 240px;
        margin-bottom: 15px;
        border: 2px;
        border-radius: 5px;
        background: bisque;
        padding: 5px;
    }

    .small-container input[type=submit]{
        border: 3px;
        border-radius: 15px;
        padding: 5px;
        background-color: #f44336;
        margin-left: 115px;
    }

    .btn:hover {  
    opacity: 0.8;  
  }  

</style>