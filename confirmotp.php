<?php include "inc/header.php"; ?>

<?php 
  $login_check = Session::get('customer_login');
  if($login_check == false)
  {
      header('Location:dangnhap.php');
  } 
  else
  {
    $id_doipass = $_SESSION['customer_id'];
  }
?>

<?php    
  $idd = Session::get('customer_id');
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
  {
    $updatepw = $cs->update_pw($_POST,$idd);
  }
?>

<form action="" method="post">
    <BR>
<center><h4><B>ĐỔI MẬT KHẨU</B></h4></center>
<br>
<?php 
if(isset($updatepw))
{
  echo $updatepw;
}
?>
<?php 
 $id = Session::get('customer_id');
 $get_customers = $cs->show_customers($id);
  if($get_customers)
  {
    while($result = $get_customers->fetch_assoc())
    {

?>
<div class="containerr">

<center><label> Mật khẩu cũ </label>   
<input type="password" value="<?php echo $result['userpass'] ?>" size="10" readonly/> </center>  
<center><label> Mật khẩu mới </label>    
<input type="password" name="userpass" size="10" id="id_password"><i class="fas fa-eye" id="togglePassword"></i></center>
<center><label>Nhập lại mật khẩu </label>    
<input type="password" name="sdt" size="10" id = "TextBox2"/> </center>
<?php 
     }
    }
  ?>
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
      padding-right: 20px;  
  } 
  
  select{
    width: 40%;
    padding: 7px;
  }

  input[type=text], input[type=password], textarea {  
    width: 15%;  
    padding: 5px;  
    margin: 2px 2px 18px 2px;  
    display: inline-block;  
    border: none;  
    background:bisque;  
  }  

  i{
      margin-left: -24px;
      cursor: pointer;
  }

  .registerbtn {  
    background-color: #4CAF50;  
    color: white;  
    padding: 12px 15px;  
    margin: 10px 0;  
    border: none;  
    cursor: pointer;  
    width: 20%;  
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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

var id_doimk = <?php echo $id_doipass ?>;
// alert(id_doimk);
$.ajax({
  url: 'classes/action.php',
  type: 'POST',
  data: { id_doi_pass: id_doimk },
  success: function(data)
  {
    console.log(data);
    
  },
  error: function(xhr, statusText, error)
  {
    alert(xhr.status);
  }
})
</script>