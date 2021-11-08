<?php include "inc/header.php"; ?>


<?php    
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
      
      $insertcustomer = $cs->insert_customer($_POST); //dùng $_FILES để chèn thêm hình ảnh
  }
?>


<style>body{  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: #fff;
  }  


  .container {  
      padding: 50px;  
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
    padding: 16px 20px;  
    margin: 8px 0;  
    border: none;  
    cursor: pointer;  
    width: 102%;  
    opacity: 0.9;  
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

<form action="" method="post">
	<br>
	<br>
	<br>


  <div class="container">  
  <center>  <h1>ĐĂNG KÝ TÀI KHOẢN</h1>  </center>
  <?php 

if(isset($insertcustomer)){
  echo $insertcustomer;
}

?>
  <hr>  
<label> Tên Người Dùng: </label>   
<input type="text" name="username" placeholder= "Tên Người Dùng" size="15"/>   
<label> Tên Tài Khoản: </label>    
<input type="text" name="useracc" placeholder="Tên Tài Khoản" size="15"/>  
<label> Mật Khẩu: </label>    
<input type="password" name="userpass" placeholder="Mật Khẩu" size="15"/>    
<input type = "submit" name = "submit" value="Đăng Ký Tài Khoản" class="registerbtn">
</form>  
</body>  
</html>  

