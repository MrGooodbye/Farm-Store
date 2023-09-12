<?php 
    include "inc/header.php";
?>
<?php 
    include "../classes/customer.php";
?>

<?php include_once "../helper/format.php"; ?>



<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 10px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
                   th {padding-right: 23px;}
</style>


<?php
$customer = new customer();
$fm = new Format();
?>



<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Người Dùng</h2></center>
        <div class="block"> 
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<th>Tên Khách Hàng</th>
					<th>Ngày Đăng Ký</th>
          <th>Chi Tiết</th>
				</tr>
			</thead>

			<tbody>
				
				<?php
				

				$show_all_customer = $customer->show_all_customer();
				if($show_all_customer) 
				{
					
				while ($result = $show_all_customer->fetch_assoc()){
				
				?>

				<tr class="oddgradeX">
                    <td><?php echo $result['username']?></td>
					<td><?php echo $result['regis_date']?></td>
                    <td><a href="?regisId=<?php echo $result['regisId']?>">Xem chi tiết</a></td>
					<hr>
				</tr>
				<?php
					}
				}else{
					echo '<span class="error"><center>Hiện tại chưa có Khách Hàng nào đăng ký tạo tài khoản ở shop của bạn cả. Vui lòng quay lại sau!</center></span><br>';
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<?php 
  if(isset($_GET['regisId']))
  {
    $user_id = $_GET['regisId'];
    $show_user_details = $customer->show_user_details($user_id);
?>
       
        <div class="popup" id="popup1"> 
        <a href="userlist.php"><i class="fa-sharp fa-solid fa-circle-xmark fa-2x" id="fa"></i></a>
        <hr>
          <table id="details">
            <tr>
              <th><B>Tên Người Dùng</B></th>
              <th><B>Tên Tài Khoản</B></th>
              <th><B>Mail</B></th>
              <th><B>Giới Tính</B></th>
              <th><B>Ngày Đăng Ký</B></th>
            </tr>
<?php                        
    if($show_user_details)
    {
      while($result_show = $show_user_details->fetch_assoc())
      {
?>        
        <tr>
          <td><?php echo $result_show['username']?></td>
          <td><?php echo $result_show['useracc']?></td>
          <td><?php echo $result_show['email']?></td>
          <?php $gender = $result_show['gioitinh'] ? 'Nam':'Nữ'?>
          <td><?php echo $gender?></td>
          <td><?php echo $result_show['regis_date']?></td>
        </tr>
<?php      
      }
    }
  }
  else{
  }
?>
</table>
</div>
<style>
 
.popup{
  width: 47%;
  height: 150px;
  margin-top: 285px;
  background-color: #fff;
  position: absolute;
  z-index: 10000;
  margin-left: 500px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: none;
  border-radius: 22px;
}

.td img{
    width: 10px;
    background-color: red;
}

.popup h4{
  color: red;
  font-size: 18px;
  margin-bottom: 15px;
  margin-top: -4px;
}

.popup hr{
    padding-bottom: 5px;
}

#fa{
  margin-left: 97%;
  cursor: pointer;
}

#details th{
  padding-top: 10px;
  padding-right: 12px;
  text-align: center;
  background-color: #0000;
  color: orangered;
}

#details td{
  text-align: center;
  padding-right: 15px;
}

#popup1{
  -webkit-box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
  box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
}

</style>            




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<script>
 $(document).ready(function () 
 {
    //việt hoá ngôn ngữ
    $('#example').DataTable({
        "language": {
        "lengthMenu": "Hiển thị _MENU_ Người Dùng",
        "info": "Tổng số Người Dùng là _TOTAL_",
        "search": "Tìm Người Dùng: ",
        "paginate": 
        {
            "first":      "Đầu",
            "last":       "Cuối",
            "next":       "Tiếp",
            "previous":   "Lùi"
        },
        "zeroRecords":    "Không tìm thấy Người Dùng này",
        "infoEmpty":      "Tìm thấy 0 Người Dùng",
        "infoFiltered":   "(được lọc từ tổng số _MAX_ Người Dùng trong danh sách)",
        },
    })
    //gán biến table cho table id example để lấy data
 })
</script>


<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>



