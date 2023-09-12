<?php include "inc/header.php"; ?>



<style>body{  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: #fff;
  }  


  .container {  
      padding: 50px;  
  }  
    
  input[type=text], input[type=password], textarea {  
    width: 70%;  
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
    padding: 10px 0px 10px 0px;  
    margin: 0 auto;
    border: none;
    border-radius: 15px;  
    display: block;
    align-items: center;
    margin-bottom: 20px;
    text-align: center;
    cursor: pointer;  
    width: 14.8%;  
    text-align: center;
  }  
  .registerbtn:hover {  
    opacity: 1;  
  }  </style>



<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<link rel="stylesheet" href="CSS/Dang Ky Dat Cho.css">  
</head>  
<body>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>#dangky" method="post">
	<br>
	<br>
	<br>


  <div class="container">  
  <center>  <h1>ĐĂNG KÝ TÀI KHOẢN</h1>  </center>


  
<?php    
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
    $insertcustomer = $cs->insert_customer($_POST); 
  }
?>




  <?php 

if(isset($insertcustomer)){
  echo $insertcustomer;
}

?>
  <hr>  
<center><label> Tên Người Dùng: </label> 
<input type="text" name="username" placeholder= "Tên Người Dùng" size="15" id="dangky" autofocus/>  </center>   
<center><label> Tên Tài Khoản: </label>   
<input type="text" name="useracc" placeholder="Tên Tài Khoản" size="15"  />  </center> 
<center><label> Mật Khẩu: </label>    
<input type="password" name="userpass" placeholder="Mật Khẩu" size="15" id = "t1" />
<i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></center>
<input type = "submit" name = "submit" id = "logButton" value="Đăng Ký Tài Khoản" onclick="registration()" class="registerbtn">
<a href="dangnhap.php#dangnhap" class="registerbtn">Đăng Nhập</a>

</form>  
</body>  
</html>  

<script>
   const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#t1');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>


