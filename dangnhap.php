<?php include "inc/header.php"; ?>


<?php 
    
        $login_check = Session::get('customer_login');
            if($login_check)
            {
              echo "<script>window.location = 'Location:cart.php'</script>";
            }    
            else
            {
              
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
    width: 67%;  
    padding: 15px;  
    margin: 5px 0 22px 0;  
    display: inline-block;  
    border: none;  
    background:bisque;  
  }  
  input[type=text]:focus, textarea:focus, input[type=password]:focus {  
    /* background-color: #fff;   */
    outline: none;  
  }  

  hr {  
    border: 1px solid #f1f1f1;  
    margin-bottom: 25px;  
  }  

  .registerbtn {  
    background-color: #4CAF50;  
    color: white;  
    padding: 13px 2px;  
    margin: 3px 0;  
    border: none;  
    cursor: pointer;  
    width: 30%;  
    opacity: 0.9;  
    border-radius: 10px;
    margin-bottom: 10px;  
  }  
  .registerbtn:hover {  
    opacity: 1;  
  }  
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<body>   
<form action = "" method = "post"> 
  <div class="container">
  <center>  <h1>ĐĂNG NHẬP</h1>  </center>

  
  <hr>  
<center><label> Tài Khoản: </label>
<input type="text" name="User" placeholder= "Tài Khoản" size="15" id = "dangnhap" autofocus/></center>

<center><label> Mật Khẩu: </label>
<input type="password" name="Pass" placeholder="Mật Khẩu" size="15" id="id_password">
<i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></center>

<center><input type = "submit" name="login" id="submit" value="Đăng Nhập" class="registerbtn"></center>
<center><a href="quenmatkhau.php">Quên mật khẩu</a></center>
</form>  
</body>  

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>



