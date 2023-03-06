<?php
  include "../classes/adminlogin.php";
?>
  
<?php
  $class = new adminlogin();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $adminUser = $_POST['adminUser'];
      $adminPass = md5($_POST['adminPass']);
      $login_check = $class->login_admin($adminUser,$adminPass);
  }

?>

</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>


<!DOCTYPE html>
<html>  
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  align-items: center;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 30%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

/*page login.php sẽ gửi tất cả thông số dữ liệu tới chính nó bằng phương thức post */
</style>
</head>
<body>

<center><h2>Đăng Nhập Admin</h2></center>
<span><?php

if(isset($login_check))
{
  echo $login_check;
}

?>
  
</span>

<form action="login.php" method="post"> 


  <div class="container">
    <label for="uname"><center><b>Tài Khoản</b>  </label>
    <input type="text" placeholder="Nhập Tài Khoản Admin" name="adminUser">
  </br>
    <label for="psw"><b>Mật Khẩu </b></label>
    <input type="password" placeholder="Nhập Mật Khẩu Admin" name="adminPass" >
        <style>.container .input {color:  red;}</style>
      </br>
    <button type="submit" name="submit">Đăng Nhập </button> </center>
    <center><button type="button" class="cancelbtn">Hủy</button></center>
  </div>

  <div class="container" style="background-color:#f1f1f1">
      <center><a href="#">Bạn Quên Mật Khẩu?</a></center>
  </div>
</form>
</body>
</html>
