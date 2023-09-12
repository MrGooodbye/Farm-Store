<?php include "inc/header.php";?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/storage.php"; ?>
<?php include_once "../helper/format.php"; ?>

<?php
	$fm = new Format();
	$storage = new storage();
	if(isset($_GET['productId'])){

    $Id = $_GET['productId'];
    $delpd = $pd->del_product($Id);
    }
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 76px;
                       	padding-top: 15px;
                       	padding-bottom: 7px;
                     }
					 img{
						max-width: 150%;
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
  margin-left: 100px;
  padding: 10px;
  background: #fff;
  border-radius: 5px;
  width: 40%;
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
</style>




<div class="containe" id="container">  
<span id="popup1" class="overlay">
	<div class="popup">
	Cửa hàng của bạn hôm nay hiện chưa có sản phẩm được nhập vào kho!
	</div>
</span>
</div>

<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Sản Phẩm Trong Kho</h2></center>
        <div class="block"> 
        	<?php
        		if(isset($delpd)){
        			echo $delpd;
        		}

        	?>
        	
<button class="button" name="inexcel" id="in_excel_btn" >In Danh Sách Nhập Kho</button>
<button class="button" name="inexcel_homnay" id="in_excel_homnay_btn" >In Danh Sách Nhập Kho Hôm Nay</button>
            <table class="data display datatable" id="example">
			<thead>
				</br>   
				<tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Loại Sản Phẩm</th>
                    <th>Nhà Phân Phối</th>
					<th>Số Lượng Trong Kho</th>
					<th>Tổng Giá Nhập</th>
					<th>Ảnh Sản Phẩm</th>
                    <th>Ngày Nhập Kho</th>
					<th>Tiến Hành</th>
				</tr>
			</thead>

			<tbody>
				<?php
				
				$pd_storage_list = $storage->show_storage();
				if($pd_storage_list){
					$i = 0;
					while($result = $pd_storage_list->fetch_assoc()){
						$i++;
				?>
				<tr class="oddgradeX">
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['catName']?></td>
                    <td><?php echo $result['supplier']?></td>
                    <td><?php echo $result['quantity']?></td>
                    <td><?php echo $fm->format_currency($result['import_price'])." "."VNĐ"?></td>
                    <td><img src ="uploads/nhapkho/<?php echo $result['image'] ?>" width="100"></td>
                    <td><?php echo $result['import_date']?></td>				
					<td><a href="productadd.php?id_sp_storage=<?php echo $result['Idproduct'] ?>">Xuất kho</a></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

<script>
$(document).ready(function () 
{
  var table = $('#example').DataTable();
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
		var ten = 'Danh Sách Nhập Kho';
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

		var ten = 'Nhập Kho Ngày ';
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

	document.getElementById("in_excel_btn").addEventListener("click", in_danhsach_xuatkho);
	function in_danhsach_xuatkho()
	{
		$.ajax({
			url: '../classes/action.php',
			type: 'POST',
			data: { indanhsach_nhapkho: ""},
			success: function(data)
			{
				// alert(data)
				const data_map = data.map(row => ({
					// 'id_sp' => $IdProduct, 'supplier_sp' => $Supplier, 'loai_sp' => $TypeProduct, 'ten_sp' => $ProductName, 
					// 'sl_sp' => $QuantityProduct, 'gia_sp' => $ImportPrice, 'ngaynhap_sp' => $ImportDate);
					'Mã Sản Phẩm': row.id_sp,
					'Nhà Cung Cấp': row.supplier_sp,
					'Loại Sản Phẩm': row.loai_sp,
					'Tên Sản Phẩm': row.ten_sp,
					'Số Lượng Đã Nhập': row.sl_sp,
					'Tổng Giá Đã Nhập': row.gia_sp,
					'Ngày Nhập Kho': row.ngaynhap_sp
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
		})
	}

	document.getElementById("in_excel_homnay_btn").addEventListener("click", in_danhsach_nhapkho_homnay);
	function in_danhsach_nhapkho_homnay()
	{
		// alert("xzcvxzvxzcv");
		$.ajax({
			url: '../classes/action.php',
			type: 'POST',
			data: { indanhsach_nhapkho_homnay: ""},
			success: function(data)
			{
				// alert(data)
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
					const data_map = data.map(row => ({
						'Mã Sản Phẩm': row.id_sp,
						'Nhà Cung Cấp': row.supplier_sp,
						'Loại Sản Phẩm': row.loai_sp,
						'Tên Sản Phẩm': row.ten_sp,
						'Số Lượng Đã Nhập': row.sl_sp,
						'Tổng Giá Đã Nhập': row.gia_sp,
						'Ngày Nhập Kho': row.ngaynhap_sp
					}));
					// console.log(data_map);
					const csvData = objectToCsv(data_map);
					download_excel_homnay(csvData);
				}
			},
			error: function(xhr, statusText, error)
			{
				alert(xhr.status);
			}
		})
	}

</script>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>



