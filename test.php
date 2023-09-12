<?php 
require ("carbon/autoload.php");
use Carbon\Carbon;
use Carbon\CarbonInterval;
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://kit.fontawesome.com/d5e3c07cf1.js" crossorigin="anonymous"></script>

<html>



<body>
<select name="xuly" id="xuly_ship">
                        <option>Xử lý Trạng Thái</option>
                        <option value="shipped">Đã Nhận Hàng</option>
                        <option value="cancel">Đã Huỷ</option>
                    </select>

</body>

</html>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
 const myWorker = new Worker("worker.js");
 myWorker.

$( "#xuly_ship" ).change(function() {
  var status = this.value;
  alert(status);
});
</script>

<!-- SELECT customer.Country, COUNT(customer.Sex) as CustomerFemale 
FROM customer
WHERE customer.Sex = 'false'
GROUP BY customer.Country
HAVING COUNT(customer.Sex) > 1
ORDER BY customer.Sex -->

<?php
// date_default_timezone_set('Asia/Ho_Chi_Minh');
// $now = new DateTime(); //now
// echo $now->format('d/m/Y H:i:s');

//$now = Carbon::now('Asia/Ho_Chi_Minh');
//$nowformat = $now->format('d/m/Y H:i');
//echo $nowformat;
?>


<?php 
$now = Carbon::now('Asia/Ho_Chi_Minh');
$nowformat = $now->format('d/m/Y H:i');

$day = "05/05/2023 21:30";
if($nowformat > $day)
{
  echo 'a';
}
elseif($nowformat == $day)
{
  echo 'b';
}
else
{
  echo 'c';
}
?>
