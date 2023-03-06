<?php include "inc/header.php"; ?>
<form action="" method="post">
    <BR>
<center><h4><B>ĐỔI MẬT KHẨU</B></h4></center>
<br>

<div class="containerr">
<center><h6>Hãy nhập tài khoản của bạn</h6></center>
<center><label> Tài khoản của bạn</label>   
<input type="text"  size="10"/> </center>  

</div>
<center><input type = "submit" name = "submit" id = "logButton" value="Đổi mật khẩu" class="registerbtn"></center>
</form>  
</div>
</div>

<br>
<?php include "inc/footer.php"; ?>


<style>
  .container {  
      padding: 50px;  
      
  }  

  .containerr {  
      padding right: 20px;  
  } 
  
  select{
    width: 40%;
    padding: 7px;
  }

  input[type=text], textarea {  
    width: 45%;  
    padding: 13px;  
    margin: 2px 2px 22px 2px;  
    display: inline-block;  
    border: none;  
    background:bisque;  
  }  

  hr {  
    border: 1px solid black;  
    margin-bottom: 20px;  
  }  
  .registerbtn {  
    background-color: #4CAF50;  
    color: white;  
    padding: 12px 15px;  
    margin: 10px 0;  
    border: none;  
    cursor: pointer;  
    width: 50%;  
    opacity: 0.9;  
    border-radius: 50px;
  }  
  .registerbtn:hover {  
    opacity: 1;  
  }  


  #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 122%;
}

#customers td, #customers th {
  border: 0px;
  padding: 6px;
}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  padding-right: 10px;
  text-align: left;
  background-color: #0000;
  color: black;
  width: 10%
}

#customers td{
    text-align: left;
}

#imageUpload
{
    display: none;
}

#profileImage
{
    cursor: pointer;
}

#profile-container {
  
    width: 120px;
    height: 98px;
    overflow: hidden;
    
    border-radius: 50%;
    float: left;
}

#profile-container img {
    width: 140px;
    height: 127px;
}

.avatar {
  
  width: 120px;
  height: 100px;
  border-radius: 50%;
  overflow: hidden;
  float: left;
}

#a{
  font-size: 20px;
}

</style>