<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://kit.fontawesome.com/d5e3c07cf1.js" crossorigin="anonymous"></script>

<html>



<body>
  <?php
  #$a = 5;
  #echo $a++ + $a - +-$a + ++$a + $a++ + ++$a - $a - +$a;
  //5                 6     5      6      
  ?>

  <?php
  #define('echoo', 'My constant value');

  #echo constant('echo'); // outputs 'My constant value'
  ?>
  <!-- <input type="text" id="number" onkeyup="formatNumber(this);">
<span class="col-xs-3">VNĐ<span>

<p>Thống kê đơn hàng theo : <span id="text-date"></span></p>
<p>
	<select class="select-date">
		<option value="7ngay">7 ngày qua</option>
		<option value="28ngay">28 ngày qua</option>
		<option value="90ngay">90 ngày qua</option>
		<option value="365ngay">365 ngày qua</option>
	</select>
</p>

<?php
//   $str = '123 456 789';
//   $input = preg_replace("/[^a-zA-Z]+/", "", $str);
//   echo $input;

//   $str = 'This is a simple piece of text.';
// $new_str = str_replace(' ', '', $str);
// echo $new_str; // Outputs: Thisisasimplepieceoftext.
?>





<script>
    function formatNumber(a) {
  // format number 1000000 to 1,234,567
  a.value = a.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");


}
</script>

<style>
.col-xs-3{
  margin-left: -45px;
}
</style>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<div id="myfirstchart" style="height: 250px;"></div>

<script type="text/javascript">
  new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>



    <script type="text/javascript">

   	$(document).ready(function()
    {
        thongke();
        var char = new Morris.Area
        ({
          
        element: 'chart',
      
        xkey: 'year',
      
        ykeys: ['order','sales','quantity'],
      
        labels: ['Đơn hàng','Doanh thu','Số lượng bán ra']
      });

      function thongke()
      {
        var text = '365 ngày qua';
        $('#text-date').text(text);
        // $.ajax
        // ({
        //   url
        //   method:"POST",
        //   dataType: "JSON",

        //   success:function(data);
        //   {
        //     char.setData(data);
        //     $('#text-date').text(text);
        //   }
        // });
      }
  });
    </script> -->

  <style>
  img {
  max-width: 9em;
  width: 150px;
  overflow: hidden; 
  margin-right: 1em;
}

a {
  text-decoration: none;
}

.container {
  max-width: 75em;
  width: 95%;
  margin: 40px auto;  
  overflow: hidden;
  position: relative;
  
  border-radius: 0.6em;
  background: #ecf0f1;
  box-shadow: 0 0.5em 0 rgba(138, 148, 152, 0.2);
}

.heading {
  padding-top: 2px;
  padding-bottom: 2px;
  position: relative;
  z-index: 1;
  color: #f7f7f7;
  background: #f34d35;
}

.cart {
  margin: 2.5em;
  overflow: hidden;
}

.cart.is-closed {
  height: 0;
  margin-top: -2.5em;
}

.table {
  background: #ffffff;
  border-radius: 0.6em;
  overflow: hidden;
  clear: both;
  margin-bottom: 1.8em;
}


.layout-inline > * {
  display: inline-block;
}

.align-center {
  text-align: center;
}

.th {
  background: #f34d35;
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 1.5em;
}

.tf {
  background: #fff;
  text-transform: uppercase;
  text-align: right;
  font-size: 1.2em;
}

.tf B{
  color: deeppink;
  font-size: 22px;
  float: left;
  padding-right: 150px;
}

.tf p {
  color: black;
  font-weight: bold;

  float: right;
  padding-left: 70px;
}

.col {
  padding: 25px;
  width: 15%;
  margin-bottom: 0px;
}

.col-pro {
  width: 30%;
}

.col-pro > * {
  vertical-align: middle;
}

.col-pro p {
  padding-bottom: 0px;
  margin: 0px;
}

.col-qty {
  text-align: center;
  width: 17%;
}

.col-numeric p {
  font: bold 1.8em helvetica;
}

.col-total p {
  color: #12c8b1;
}

.tf .col {
  width: 20%;
}

.row > div {
  vertical-align: middle;
}

.row-bg2 {
  background: #f7f7f7;
}

.visibility-cart {
  position: absolute;
  color: #fff;
  top: 0.5em;
  right: 0.5em;
  font:  bold 2em arial;
  border: 0.16em solid #fff;
  border-radius: 2.5em;
  padding: 0 0.22em 0 0.25em ;
}

.col-qty > * {
  vertical-align: middle; 
}

.col-qty > input {
  max-width: 2.6em;
}


a.qty {
  width: 1em;
  line-height: 1em;
  border-radius: 2em;
  font-size: 2.5em;
  font-weight: bold;
  text-align: center;
  background: #43ace3;  
  color: #fff;
}

a.qty:hover {
  background: #3b9ac6;
}

.btn {
  padding: 10px 30px;
  border-radius: 0.3em;
  font-size: 1.4em;
  font-weight: bold;
  background: #43ace3;
  color: #fff;
  box-shadow: 0 3px 0 rgba(59,154,198, 1)
}

.btn:hover {
  opacity: 0.7;
}

.btn-update {
  float: right;
  margin: 0 0 1.5em 0;
}

.btn-thanhtoan{
  display: flex;
  justify-content: center;
  padding-top: 15px;
  padding-bottom: 15px;
  margin: 0 auto;
  width: 15%;
  border: none;
  border-radius: 15px;
}

.transition {
  transition: all 0.3s ease-in-out;
}

@media screen and ( max-width: 755px) {
  .container {
    width: 98%;
  }
  
  .col-pro {
    width: 35%;
  }
  
  .col-qty {
    width: 22%;
  }
  
  img {
    width: 20px;
    margin-bottom: 1em;
  }
}

@media screen and ( max-width: 591px) {
  
}
</style>


<div class="container">
  <div class="heading">
    <h1>
      <span class="shopper"><center>Giỏ Hàng</center></span>
    </h1>
  </div>
  
  <div class="cart transition is-open">
    <div class="table">
      <div class="layout-inline row th">
        <div class="col col-pro">Sản Phẩm</div>
        <div class="col col-price align-center "> 
          Đơn Giá
        </div>
        <div class="col col-qty align-center">Số Lượng</div>
        <div class="col">Tổng Tiền</div>
      </div>
      
      <!-- bắt đầu item cart -->
      <div class="layout-inline row">

        <div class="col col-pro layout-inline">
          <img src="image/20201125_143129_322415_rau-ngot-1800x1800.jpg" alt="kitten" />
          <p>Happy Little Critter</p>
          <br>
          
        </div>
        
        <div class="col col-price col-numeric align-center ">
          <p>£59.99</p>
        </div>

        <div class="col col-qty layout-inline">
          <a href="#" class="qty qty-minus">-</a>
            <input type="numeric" value="3" />
          <a href="#" class="qty qty-plus">+</a>
        </div>
        
        <div class="col col-total col-numeric">               
          <p> £182.95</p>
        </div>

        <a href="#"><i class="fa-solid fa-trash fa-2x"></i></a>

        
      </div>
      <!-- kết thúc item cart -->
      
      <hr>
       
       <div class="tf">
          <div class="row layout-inline">
            <div class="col">
             <p>Tổng Số Tiền</p>
            </div>
           <div class="col">
              <p><B>123123213</B></p>
           </div>
            </div>
        </div>        
  </div>


    
    <a href="#" class="btn btn-thanhtoan">Thanh Toán</a>
  
</div>

</body>

</html>

<!-- SELECT customer.Country, COUNT(customer.Sex) as CustomerFemale 
FROM customer
WHERE customer.Sex = 'false'
GROUP BY customer.Country
HAVING COUNT(customer.Sex) > 1
ORDER BY customer.Sex -->
