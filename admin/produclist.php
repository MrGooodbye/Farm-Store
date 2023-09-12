<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include_once "../helper/format.php"; ?>
<?php
	$fm = new Format();
	$pd = new product();
	if(isset($_GET['productId']))
	{
    $Id = $_GET['productId'];
    $delpd = $pd->del_product($Id);
    }

	elseif(isset($_POST['add_sale']))
	{
		$add_sale_id = $_GET['themKMchoId'];
		$insertSale = $pd->insert_sale($_POST, $add_sale_id);
	}
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 25px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }

					 #example th{
						padding-right: 30px;
						
					 }

					 .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  border-radius: 15px;
  margin-bottom: 20px;
  float: right;
}

#popup1{
  margin: 55px auto;
  margin-left: 200px;
  padding: 10px;
  background: #fff;
  border-radius: 5px;
  width: 37%;
  position: absolute;
  border: none;
  border-radius: 15px;
  border-style: solid;
  float: right;
  z-index: 999999px;
  font-size: 18px;
  font-family: Tahoma, Arial, sans-serif;
  color: white;
  background-color: red;
  /* display: none; */
  /* opacity: 0.5; */
}


.button_sale {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  border-radius: 15px;
  margin: 0;
  position: absolute;
  top: 79%;
  left: 44%;
}

h2{
	margin-top: 0;
	font-weight: bold;
	text-align: center;
	padding-top: 0;
	color: red;
	font-size: 18px;
	padding-top: 10px;
}

.col-xs-3{
  margin-left: -44px;
}
</style>
<div class="containe" id="container">  
<span id="popup1" class="overlay">
	<div class="popup">
	Cửa hàng của bạn hôm nay hiện chưa có sản phẩm được xuất kho!
	</div>
</span>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Sản Phẩm Đang Bán</h2></center>
        <div class="block"> 
        	<?php
        		if(isset($delpd)){
        			echo $delpd;
        		}

        	?>
        	<button onclick="in_excel()" class="button" name="inexcel" id="in_excel_btn" >In Danh Sách Xuất Kho</button>
			<button onclick="in_excel_homnay()" class="button" name="inexcel_homnay" id="in_excel_homnay_btn" >In Danh Sách Xuất Kho Hôm Nay</button>
			
            <table class="data display datatable" id="example">
			<thead>
				</br>
				<tr>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng Đang Bán</th>
					<th>Loại Sản Phẩm</th>
					<th>Mô Tả</th>
					<th>Danh Mục</th>
					<th><center>Đơn Giá</center></th>				
					<th>Ảnh</th>
					<th>Ngày Xuất Kho</th>
					<th>Cập Nhật</th>
					<th><center>Khuyến mãi</center></th>
				</tr>
			</thead>

			<tbody>
				<?php
				$pdlist = $pd->show_product();
				if($pdlist){
					$i = 0;
					while($result = $pdlist->fetch_assoc()){
						$i++;
				?>
				<tr class="oddgradeX">
					<td><?php echo $result['productName']?></td>
					<td><center><?php echo $result['solg_from_storage']?></center></td>
					<td><?php echo $result['catName']?></td>
					<td><?php 

					echo $fm->textShorten($result['product_desc'], 21);

					?></td>
					
					<td>
						<?php
							if($result['type']==1){
								echo 'Đặc Trưng';
							}else{
								echo 'Không Đặc Trưng';
							}
						?>
					</td>
<?php 
					if($result['sale'] != 0)
					{
						$giagoc = $result['price'];
						$giatriKM = $result['sale'];
						$giaKM =  $giagoc - ($giagoc * $giatriKM / 100);						
						
						echo "<td><B><del>".$fm->format_currency($result['price'])."</del>";	
						echo "<br>";
						echo $fm->format_currency($giaKM)."</td></B>";	
					}
					else
					{
						echo "<td><B>".$fm->format_currency($result['price'])."</B></td>";						
					}
?>					
					<td><img src ="uploads/xuatkho/<?php echo $result['image'] ?>" width="100"></td>
					<td><?php echo $result['export_date'] ?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Sửa</a> 
					<br>
					<a href="?productId=<?php echo $result['productId'] ?>">Xóa</a></td>					
<?php 
					if($result['solg_from_storage'] == 0)
					{
						echo '<td><h5><center>Số lượng đang bán hiện tại đã hết! Hãy thêm mới.</center></h5></td>';
					}
					else
					{
						if($result['sale'] == 0)
						{
?>						
							<td id="test"><a href="?themKMchoId=<?php echo $result['productId'] ?>"><center>Thêm</center></a></td>
<?php						
						}
						else
						{
?>						
							<td id="test">
								<?php echo '<center><B>Giảm '.$result['sale'].' %</B></center>';
									  
									  echo '<center>Kết thúc vào <B>'.$result['sale_duration'].'</B></center>';
								?>
								
							</td>
<?php							
						}					
					}
?>					
				</tr>
<?php
				}
			}
?>
		</tbody>
	</table>

       </div>
    </div>
</div>

<?php 
  if(isset($_GET['themKMchoId']))
  {
    $product_id = $_GET['themKMchoId'];
    $show_product_name = $pd->get_details_product($product_id);
	$show_product_details = $pd->get_details_product($product_id);
?>
       
        <div class="popup2" id="popup2"> 
        <a href="produclist.php"><i class="fa-sharp fa-solid fa-circle-xmark fa-2x" id="fa"></i></a>
		<h2>Thêm Khuyến Mãi cho Sản Phẩm
<?php                        
		if($show_product_details)
		{
			while($result_name = $show_product_name->fetch_assoc())
			{
				echo $result_name['productName']
?> 
<?php 
			}
		}
?>
		</h2>
        <hr>
          <table id="details">
            <tr>
              <th><B>Tên Sản Phẩm</B></th>
              <th><B>Số Lượng Đang Bán</B></th>
              <th><B>Loại Sản Phẩm</B></th>
              <th><B>Danh Mục</B></th>
              <th><B>Đơn Giá</B></th>
			  <th><B>Ảnh</B></th>
			  <th><B>Khuyến Mãi</B></th>
			  <th><B>Thời gian Khuyến Mãi</B></th>
            </tr>
<?php                        
    if($show_product_details)
    {
      while($result_show = $show_product_details->fetch_assoc())
      {
?>        
        <tr>
		  <form action="" method="post">
          <td><?php echo $result_show['productName']?></td>
          <td><?php echo $result_show['solg_from_storage']?></td>
          <td><?php echo $result_show['catName']?></td>
		  <td><?php echo ($result_show['type']== 1) ? 'Đặc Trưng':'Không Đặc Trưng'?></td>
		  <td><?php echo $result_show['price']?></td>
		  <td><img src ="uploads/xuatkho/<?php echo $result_show['image'] ?>" width="100"></td>
		  <td><input type ="number" name="value_sale" min="1" max="100" autofocus></input> <span class="col-xs-3"><B>%</B><span></td>
		  <td><select name="sale" id="sales">
		  <!-- <option value="0.1">1 phút</option> -->
		  	<option value="3">30 phút</option>
			<option value="6">60 phút</option>
			<option value="24">1 ngày</option>
			<option value="48">2 ngày</option>
			<option value="168">7 ngày</option>
		  </select></td>
        </tr>
<?php      
      }
?>
	  <button type="submit" class="button_sale" name="add_sale">Thêm khuyến mãi</button>
	  </form>
<?php
    }
  }
  else{
  }
?>
</table>
</div>

<style> 
 .popup2{
  width: 70%;
  height: 240px;
  margin-top: 290px;
  background-color: #fff;
  position: fixed;
  z-index: 10000;
  margin-left: 260px;
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

.popup2 h4{
  color: red;
  font-size: 18px;
  margin-bottom: 15px;
  margin-top: -4px;
}

.popup2 hr{
    margin-top: 13px;
}

.popup2 input{
	border: 2px solid ;
	border-radius: 20px;
	text-align: center;
	width: 100%;
	margin-left: -30px;
}

.popup2 select{
	border: 2px solid ;
	border-radius: 20px;
	text-align: center;
	width: 80%;
}

#fa{
  left: 97.5%;
  top:-1%;
  cursor: pointer;
  position: absolute;
}

#details th{
  padding-top: 10px;
  padding-right: 25px;
  text-align: center;
  background-color: #0000;
  color: blue;
  
}

#details td{
  text-align: center;
  padding-right: 15px;
 
}

#popup2{
  -webkit-box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
  box-shadow:  0px 0px 0px 9999px rgba(0, 0, 0, 0.5);
}
</style>            


<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

<script>
$(document).ready(function () 
{
	$('#example').DataTable();
})
</script>

<script>
	$('#popup1').hide();
	const objectToCsv = function(data_map)
	{
		const csvRows = [];
		//headers
		const headers = Object.keys(data_map[0]);
		csvRows.push(headers.join(','));

		// console.log(headers);

		//lặp data_map
		for (const row of data_map)
		{
			const value = headers.map(header => 
			{
				const escaped = (''+row[header]).replace(/"/g, '\\"');
				return `"${escaped}"`;
			});
			csvRows.push(value.join(','));
		}
		// console.log(csvRows);
		//bỏ dấu "" dư đi
		return csvRows.join('\n');
	}

	const download = function(data)
	{
		const date = new Date();

		let day = date.getDate();
		let month = date.getMonth() + 1;
		let year = date.getFullYear();

		var ten = 'Danh Sách Xuất Kho';
		var xls=".xls";
		var xlsfile=ten+xls;
		const BOM = '\uFEFF';

		const blob = new Blob([BOM + data], { type: 'text/csv;charset=utf-8' });
		const url = window.URL.createObjectURL(blob);
		const a = document.createElement('a');
		a.href = url;
		a.setAttribute('download', xlsfile);
		a.click();
		// a.setAttribute('href', url);
		// a.setAttribute('download', 'download.csv');
		// document.body.appendChild(a);
		// a.click();
		// document.body.removeChild(a);
	};

	const download_excel_homnay = function(data)
	{
		const date = new Date();

		let day = date.getDate();
		let month = date.getMonth() + 1;
		let year = date.getFullYear();

		var ten = 'Xuất Kho Ngày ';
		let currentDate = `${day}-${month}-${year}`;
		var xls=".xls";
		var xlsfile=ten+currentDate+xls;
		const BOM = '\uFEFF';

		const blob = new Blob([BOM + data], { type: 'text/csv;charset=utf-8' });
		const url = window.URL.createObjectURL(blob);
		const a = document.createElement('a');
		a.href = url;
		a.setAttribute('download', xlsfile);
		a.click();
		// a.setAttribute('href', url);
		// a.setAttribute('download', 'download.csv');
		// document.body.appendChild(a);
		// a.click();
		// document.body.removeChild(a);
	};

	function in_excel()
	{
		// alert("dxvxzcvxzcv");
		$.ajax({
			url: '../classes/action.php',
			type: 'POST',
			data: { infile_excel: "" },
			success: function(data, status)
			{
				// alert(data);
				console.log(data);
				//fomart thành object để cho vào biến objectToCsv
				const data_map = data.map(row => ({
					'Tên Sản Phẩm': row.ten_sp,
					'Số Lượng Đang Bán': row.sl_sp,
					'Loại Sản Phẩm': row.loai_sp,
					'Mô Tả': row.mota_sp,
					'Danh Mục Sản Phẩm': row.danhmuc_sp,
					'Đơn Giá': row.gia_sp,
					'Ngày Xuất Kho': row.ngayxuat_sp
				}));
				// console.log(data_map);
				const csvData = objectToCsv(data_map);
				// console.log(csvData);
				download(csvData);
			},
			error: function(xhr, statusText, error)
			{
				alert(xhr.status);
			}

		});
	}

	function in_excel_homnay()
	{
		$.ajax({
			url: '../classes/action.php',
			type: 'POST',
			data: { in_xuatkho_homnay: "" },
			success: function(data)
			{
				// alert(data);
				if(data == 0)
				{
					$( "#popup1" ).hide().fadeIn(); 
					timer = setTimeout(function () 
					{
						$( "#popup1" ).fadeOut();
					},5000)
				}
				else
				{
					// alert(data);
					const data_map = data.map(row => ({
					'Tên Sản Phẩm': row.ten_sp,
					'Số Lượng Đang Bán': row.sl_sp,
					'Loại Sản Phẩm': row.loai_sp,
					'Mô Tả': row.mota_sp,
					'Danh Mục Sản Phẩm': row.danhmuc_sp,
					'Đơn Giá': row.gia_sp,
					'Ngày Xuất Kho': row.ngayxuat_sp
				}));
					// console.log(data_map);
					const csvData = objectToCsv(data_map);
					// console.log(csvData);
					download_excel_homnay(csvData);
				}
			},

			error: function(xhr, statusText, error)
			{
				alert(xhr.status);
			}
		});
	}
</script>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>

