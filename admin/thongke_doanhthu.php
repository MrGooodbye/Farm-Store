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

<body>
    <div style="padding: 10px 0px 10px 20px; height: 0px">
        <label for="thong_ke_doanh_thu">Thống kê doanh thu</label>
        <select id="thong_ke_doanh_thu">
            <option value="" disabled selected hidden>theo</option>
            <option value="7">7 ngày</option>
            <option value="30">1 tháng</option>
            <option value="90">3 tháng</option>
            <option value="180">6 tháng</option>
            <option value="365">12 tháng</option>
        </select>
    </div>
    <div id="myfirstchart" style="height: 250px; top: 100px;"></div>
    <div id="myfirstchart1" style="height: 250px; top: 100px;"></div>
    <div id="myfirstchart2" style="height: 250px; top: 100px;"></div>
    <div id="myfirstchart3" style="height: 250px; top: 100px;"></div>
    <div id="myfirstchart" style="height: 250px; top: 100px;"></div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
$(document).ready(function()
{
    $("#thong_ke_doanh_thu").change(function(e){
        var thoigian = $(this).val();
        // console.log(thoigian);
        $.ajax({
            type: "POST",
            url: "../classes/action.php",
            data: { thoigian_thongke_doanhthu: thoigian },
            success: function (response) 
            {
                var data = JSON.stringify(response);
                thongke_doanhthu(data)
                // Morris.Line
                // ({
                //     element: 'myfirstchart',
                //     data: JSON.parse(data),
                //     xkey: 'ngay_ban',
                //     ykeys: ['tong_doanhthu','tong_sodonhang','tong_soluongban'],
                //     labels: ['Tổng doanh thu','Tổng số đơn hàng','Tổng số lượng đã bán'],
                //     //lables là label của input
                //     //ykeys là value trong input của label

                //     //stacked: true
                // });
            }
        });
    })

    function thongke_doanhthu(data)
    {
    Morris.Line
                ({
                    element: 'myfirstchart',
                    data: JSON.parse(data),
                    xkey: 'ngay_ban',
                    ykeys: ['tong_doanhthu','tong_sodonhang','tong_soluongban'],
                    labels: ['Tổng doanh thu','Tổng số đơn hàng','Tổng số lượng đã bán'],
                    //lables là label của input
                    //ykeys là value trong input của label

                    //stacked: true
                });
    }
    });
</script>
