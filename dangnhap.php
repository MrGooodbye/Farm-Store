<?php include "inc/header.php"; ?>


<?php 
    
        $login_check = Session::get('customer_login');
            if($login_check)
            {
                header('Location:cart.php');
            }    

?>



<?php


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']))  {
      $login_customer = $cs->login_customer($_POST);
  }
?>



<style>
    body{  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: #fff;
    width: 100%;
   
  }  

  .container {  
      padding: 100px;  
  }  
    
  input[type=text], input[type=password], textarea {  
    width: 100%;  
    padding: 15px;  
    margin: 5px 0 22px 0;  
    display: inline-block;  
    border: none;  
    background:bisque;  
  }  
  input[type=text]:focus, textarea:focus, input[type=password]:focus {  
    background-color: #fff;  
    outline: none;  
  }  

  hr {  
    border: 1px solid #f1f1f1;  
    margin-bottom: 25px;  
  }  

  .registerbtn {  
    background-color: #4CAF50;  
    color: white;  
    padding: 16px 2px;  
    margin: 8px 0;  
    border: none;  
    cursor: pointer;  
    width: 106%;  
    opacity: 0.9;  
    
  }  
  .registerbtn:hover {  
    opacity: 1;  
  }  
</style>







<body>   
<form action = "" method = "post"> 
  <div class="container">
  <center>  <h1>ĐĂNG NHẬP</h1>  </center>
  <?php 
    
    if(isset($login_customer))
{
        echo $login_customer;
}

?>
  
  <hr>  
  <label> Tài Khoản: </label>   
<input type="text" name="User" placeholder= "Tài Khoản" size="15"   />   
<label> Mật Khẩu: </label>   
<input type="password" name="Pass" placeholder="Mật Khẩu" size="15" />   
<input type = "submit" name="login" value="Đăng Nhập" class="registerbtn">
</form>  
</body>  



