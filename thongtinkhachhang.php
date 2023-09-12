<?php include "inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php 
  $login_check = Session::get('customer_login');
  if($login_check == false)
  {
      header('Location:dangnhap.php');
  } 
?>

<?php    
  $idd = Session::get('customer_id');
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
    $updatecustomer = $cs->update_customers($_POST,$_FILES,$idd);
  }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="container">  
<?php 
      $id = Session::get('customer_id');
      $get_customers = $cs->show_customers($id);
      if($get_customers)
      {
        while($result = $get_customers->fetch_assoc())
        {

    ?>
<?php
  $img = $result['image'];
  if($img == NULL)
  {
?>
    <image src="images/b.jpg" class="avatar">
<?php  
  }    
  else
  {
?>
    <img src ="avt/<?php echo $result['image'] ?>"  class="avatar">    
  <?php
  }
?>


<br>
<a name="main"></a>
<center><B><U>THÔNG TIN NGƯỜI DÙNG</U></B></center>


  <table id="customers">
    <br>
  
  <tr>
    <th><B>Tên Người Dùng</B></th>
    <th><B>Tên Tài Khoản</B></th>
    <th><B>Mật Khẩu</B></th>
    <?php
    $psw = $result['useracc'];
    $maskedPassword = str_repeat("*", strlen($psw));
    ?>
  </tr>
  <tr>
  <td><?php echo $result['username'] ?></td>
  <td><?php echo $result['useracc'] ?></td>
  <td><?php echo $maskedPassword ?><B><a href="confirmotp.php">Đổi mật khẩu</a></B></td> 
  </tr>
  <tr> 
  <th><B>Số Điện Thoại</B></th>
  <th><B>Email</B></th>
  <th><B>Địa Chỉ</B></th>
</tr>
<tr>
<td>***********</td>
<td><?php echo $result['email'] ?></td>
<td><?php echo $result['diachi'] ?></td>
  </tr>
  <tr>
  <th><B>CCCD</B></th>
  <th><B>Giới Tính</B></th>
  <th><B>Ngày Sinh</B></th>
</tr>
<td>************</td>
<td>
  <?php 
    if($result['gioitinh'] == 1) 
  {
    echo "Nam";
  }
  else{
    echo "Nữ";
  }
  ?>
</td>
<td><?php $dob = $result['ngaysinh']?><?php echo date('d/m/Y', strtotime($dob));?></td>
<?php 
     }
    }
  ?>
  </table>
  <hr>



 
      
      

    

 
    <?php 
if(isset($updatecustomer))
{
  echo $updatecustomer;
}
?>
  <center><h4><B>CHỈNH SỬA THÔNG TIN NGƯỜI DÙNG</B></h4></center>

  
<?php 
 $id = Session::get('customer_id');
 $get_customers = $cs->show_customers($id);
  if($get_customers)
  {
    while($result = $get_customers->fetch_assoc())
    {

?>
 <div id="profile-container">
  <?php
  $img = $result['image'];
  if($img == NULL)
  {
?>
    <image id="profileImage" src="images/b.jpg">
    <input type="file" name="image" id="imageUpload">  
<?php  
  }    
  else
  {
?>
<img id="profileImage" src ="avt/<?php echo $result['image'] ?>">  
<input type="file" name="image" id="imageUpload"> 
<?php
  }
?>
</div>
<div class="containerr">
    <br>
<center><label> Tên người dùng: </label>   
<input type="text" name="username" value="<?php echo $result['username'] ?>" size="10"/> </center>  
<center><label> Số điện thoại: </label>    
<input type="text" name="sdt" value=  "<?php echo $result['sdt'] ?>" size="10" id = "t1"/> </center>
<center><label> Email: </label>    
<input type="text" name="email" value="<?php echo $result['email'] ?>" size="10" id = "t1"/> </center>
<center><label> Địa chỉ: </label>    
<input type="text" name="diachi" value="<?php echo $result['diachi'] ?>" size="10" id = "t1"/> </center> 
<center><label> CCCD: </label>    
<input type="text" name="cmnd" value="<?php echo $result['cmnd'] ?>" size="10" id = "t1"/> </center>
<!-- <input type="text" class="form-control input-sm" name="guardian_officeno" placeholder="Office #" required pattern="[0-9].\d{8}|\d{11}" 
title="Only Numbers are accepted and must be 10 or 11 numbers"></td> -->
<center><label> Giới tính: </label>    
<select id="select" name="gioitinh">
<option>Chọn giới tính</option>
<?php 
if($result['gioitinh'] == 1){
?>
<option selected value="1">Nam</option>
<option value="2">Nữ</option>
<?php 
}else{
    ?>
    <option value="1">Nam</option>
    <option selected value="2">Nữ</option>
    <?php

}
    ?>
</select></center>
<br>
<center><label> Ngày sinh (Tháng/Ngày/Năm): </label>    
<input type="date" name="ngaysinh" value="<?php echo $result['ngaysinh'] ?>" size="10" id="dt"/> </center> 
<?php 
     }
    }
  ?>
</div>

<center><input type = "submit" name = "submit" id = "logButton" value="Cập Nhật Thông Tin" class="registerbtn"></center>
</form>  
</div>
</div>


<?php include "inc/footer.php"; ?>

<script>
  $("#profileImage").click(function(e) {
    $("#imageUpload").click();
});

function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#profileImage').attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
}

$("#imageUpload").change(function(){
    fasterPreview( this );
});
</script>

<style>
  .container {  
      padding: 50px;  
      
  }  

  .containerr {  
      padding-right: 20px;  
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
    height: 100px;
    overflow: hidden;
    
    border-radius: 50%;
    float: left;
}

#profile-container img {
    width: 120px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    float: left;
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