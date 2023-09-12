<?php
    include "inc/header.php";
    include "../classes/thongke.php";
    require "../carbon/autoload.php";
    use Carbon\Carbon;
	use Carbon\CarbonInterval;
    $thongke = new thongke();
?>
<body>
<?php 
    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $nowformat = $now->isoFormat('DD/MM/YYYY');
?>



            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                <div>
                <br>
                <center><B>CHÀO MỪNG BẠN ĐẾN VỚI TRANG CHỦ ADMIN - CỬA HÀNG TRANG THIẾT BỊ PC ROSÉ</B></center>
                <br>
                <center><B>Chúc bạn một ngày tốt lành!</B></center>
                <br>
                <center><B>DƯỚI ĐÂY LÀ THỐNG KÊ CHO NGÀY HÔM NAY - <?php echo $nowformat ?> </B></center>
                
                <!-- <img src="../images/nongsan.jpg" width="" height="0"> -->
                </br>
                <?php 
                            $get_thongke_homnay = $thongke->get_thongke_homnay($nowformat);
                            if($get_thongke_homnay ) 
                            {
                                while ($result = $get_thongke_homnay->fetch_assoc())
                                {    
                                    $tongsodonhang_homnay = $result['tong_sodonhang'];
                                    $tongsoluongban_homnay = $result['tong_soluongban'];
                                    $tongdoanhthu_homnay = $result['tong_doanhthu'];
                                }                     
                ?>
                                <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                                    <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                                    <div class="p-4 flex flex-col">
                                    <a href="index.php?getdonhanghomnay=<?php echo $nowformat ?>" onclick="click()"class="no-underline text-white text-lg">Tổng Số Đơn Hàng
                                    <div class="no-underline text-white text-2xl">
                                        <?php echo $tongsodonhang_homnay; ?>
                                    </div>
                                    </a>
                                    </div>
                                    </div>

                                    <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                                    <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">Tổng Doanh Thu</a>
                                    <a href="#" class="no-underline text-white text-2xl">
                                    <?php echo $fm->format_currency($tongdoanhthu_homnay)."VNĐ";?>
                                    </a>
                                    </div>
                                    </div>

                                    <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                                    <div class="p-3 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">Tổng Số Lượng Đã Bán</a>
                                    <a href="#" class="no-underline text-white text-2xl">
                                    <?php echo $fm->format_currency($tongsoluongban_homnay);?>             
                                    </a>
                                    </div>
                                    </div>
<?php
                                    $get_thongke_sanpham_homnay = $thongke->get_thongke_sanpham_homnay($nowformat);
                                    if($get_thongke_sanpham_homnay)
                                    {
                                        while($row = mysqli_fetch_assoc($get_thongke_sanpham_homnay))
                                        {
                                            $tensp_banchaynhat = $row['productName'];
                                            $soluong_sp_banchaynhat = $row['quantity'];
                                        }
                                    }
?>                                    
                                    <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                                    <div class="p-4 flex flex-col">
                                    <a href="#" class="no-underline text-white text-2xl">Bán Chạy Nhất</a>
                                    <a href="#" class="no-underline text-white text-lg">
                                    <?php echo $tensp_banchaynhat?>
                                    <br>
                                    <?php echo 'Số lượng bán ra: '.$soluong_sp_banchaynhat?>
                                    </a>
                                    </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
<?php 
                            }
                            else
                            {
                                echo "<br><br><br><br><br><center><h2 style='color:red;'><B>OOPS! CỬA HÀNG CỦA BẠN HÔM NAY HIỆN CHƯA CÓ ĐƠN HÀNG NÀO ĐỂ THỐNG KÊ CẢ! :( </B></h2></center>";
                            }
?>                
</body>
<?php 
  if(isset($_GET['getdonhanghomnay']))
  {
    $getdon_homnay = $_GET['getdonhanghomnay'];
    $show_order_details = $thongke->get_confirm_today($getdon_homnay);
?>
       
        <div class="popup" id="popup1"> 
        <a href="index.php"><i class="fa-sharp fa-solid fa-circle-xmark fa-2x" id="fa"></i></a>
        <h4 style="padding-top:10px;"><center>Đơn Đã Giao Trong Hôm Nay - <?php echo $nowformat ?></center></h4>
        <hr>
          <table id="details">
          <thead>
            <tr>
              <th><B>Tên Sản Phẩm</B></th>
              <th><B>Số Lượng</B></th>
              <th><B>Tổng Giá Tiền</B></th>
              <th><B>Hình Ảnh</B></th>
              <th><B>Thời Gian Mua</B></th>
              <th><B>Loại Thanh Toán</B></th>
              <th><B>Trạng Thái</B></th>
              <th><B>Người Nhận</B></th>
              <th><B>Số Điện Thoại</B></th>
              <th><B>Địa Chỉ Nhận</B></th>
              <th><B>Ngày Giao Hàng</B></th>
            </tr>
          </thead>
<?php                        
    if($show_order_details)
    {
      while($result_show = $show_order_details->fetch_assoc())
      {
?>        
        <tbody>
        <tr>
          <td><?php echo $result_show['productName']?></td>
          <td><?php echo $result_show['quantity']?></td>
          <td><?php echo $fm->format_currency($result_show['price'])." VNĐ"?></td>
          <td><img src ="uploads/xuatkho/<?php echo $result_show['image'] ?>" width="100"></img></td>
          <td><?php echo $result_show['paid_date']?></td>
          <td><?php echo $result_show['paid_type']?></td>
          <td>
        <?php 
                if($result_show['status']==0)
                {
                ?>
                <B>Đang chờ xử lý...</B>
                <?php
                }
                elseif($result_show['status']==1){
                ?>
                <B>Đã được xử lý</B>
                <?php
                }
                else
                {
                ?>
                <B>Giao hàng</B>
                <?php
                }
        ?>
          </td>
          <td><?php echo $result_show['hotenkhach']?></td>
          <td><?php echo $result_show['sdt']?></td>
          <td id="diachi"><?php echo $result_show['diachi']?></td>
          <td id="diachi"><?php echo $result_show['confirm_date']?></td>
        </tr>
        </tbody>
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
  width: 95%;
  height: 530px;
  margin-top: 130px;
  background-color: #fff;
  position: absolute;
  z-index: 10000;
  margin-left: 45px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: none;
  border-radius: 22px;
  padding: 0px 15px 0px 15px;
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
  left: 1480px;
  position: fixed;
  top: 112px;
}

#details th{
  padding-top: 10px;
  padding-right: 12px;
  text-align: center;
  background-color: #0000;
  color: black;
}

#details td{
  text-align: center;
}

#popup1{
  -webkit-box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
  box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
  overflow: auto;
}

</style>            


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

<script>
$(document).ready(function()
{
    $.ajax({
        url: "../classes/action.php",
        type: "POST",
        data: { today: ""},
        success: function(data)
        {
            // alert(data);
            // console.log(data);
            Morris.Bar
            ({
                element: 'myfirstchart',
                data: JSON.parse(data),
                xkey: 'ten_sp',
                ykeys: ['gia_sp','soluong_sp'],
                labels: ['Tổng Giá Đã Bán','Tổng Số lượng Đã Bán'],
                //lables là label của input
                //ykeys là value trong input của label

                stacked: true
            });
        },
        error: function(jqXHR, textStatus, errorThrown, data)
        {
            alert(jqXHR.status);
        }
    });
});
</script>
            

<script>
 $(document).ready(function () 
 {
    //việt hoá ngôn ngữ
    $('#details').DataTable({
        "language": {
        "lengthMenu": "Hiển thị _MENU_ Sản Phẩm",
        "info": "Tổng Sản Phẩm là _TOTAL_",
        "search": "Tìm Sản Phẩm: ",
        "paginate": 
        {
            "first":      "Đầu",
            "last":       "Cuối",
            "next":       "Tiếp",
            "previous":   "Lùi"
        },
        "zeroRecords":    "Không tìm thấy Sản Phẩm này",
        "infoEmpty":      "Tìm thấy 0 Sản Phẩm",
        "infoFiltered":   "(được lọc từ tổng số _MAX_ Sản Phẩm trong danh sách)",
        },
    })
    //gán biến table cho table id example để lấy data
 })
</script>