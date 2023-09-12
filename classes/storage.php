<?php
	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	require ($filepath."/../carbon/autoload.php");
    use Carbon\Carbon;
	use Carbon\CarbonInterval;
?>

<?php 
    class storage
    {
        private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_storage($data, $files)
		{
			$now = Carbon::now('Asia/Ho_Chi_Minh');
			$nowformat = $now->isoFormat('DD/MM/YYYY');

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$suppiler = mysqli_real_escape_string($this->db->link, $data['supplier']);
			$quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
			$price = mysqli_real_escape_string($this->db->link, $data['import_price']);

			$newprice = $this->fm->RemoveSpecialCharSpace($price);

			// $check = @getimagesize($_FILES['image']['tmp_name']);
			// if($check == "")
			// {
			// 	echo '1';
			// }
			
			
			//kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			

			$maxsize = 1024 * 1024;
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/nhapkho/".$unique_image;

			if(empty($suppiler) && empty($category) && empty($productName) && empty($quantity) && empty($price) && empty($paid_import) && empty($file_name))
			{
				$alert = "<span class='error'>Vui lòng nhập Tên Sản Phẩm, Loại Sản Phẩm, Mô Tả, Giá Bán, chèn Ảnh, Danh Mục của Sản Phẩm!</span>";
				return $alert;
			}

			else
			{
				$check_name = "SELECT * FROM tbl_storage WHERE productName = '$productName' LIMIT 1";
				$result_check = $this->db->select($check_name);
				if($result_check)
				{
					while($row = mysqli_fetch_assoc($result_check))
					{
						$id_sanpham_import = $row['Idproduct'];
						$soluong_trongkho = $row['quantity'];
						unlink('uploads/nhapkho/'.$row['image']);
					}

					move_uploaded_file($file_temp, $uploaded_image); 
					$tong_soluong_saukhi_import = $soluong_trongkho + $quantity;
					$update_query_sanpham_import = "UPDATE tbl_storage SET quantity = '$tong_soluong_saukhi_import', import_date = '$nowformat', image = '$unique_image' WHERE Idproduct = '$id_sanpham_import'";
					$result_update_import = $this->db->update($update_query_sanpham_import);
					if($result_update_import)
					{
						echo '<script>alert("Đã Cập Nhật Sản Phẩm vào Kho thành công!")</script>';
						echo '<script>window.location = "storage.php"</script>';
					}
				}
				else
				{
					move_uploaded_file($file_temp, $uploaded_image); //dùng để lấy tên của file hình ảnh tạm đó để gửi vào $file_temp sau đó upload vào folder uploads

					$query = "INSERT INTO tbl_storage(supplier,catId,productName,quantity,import_price,import_date,image) VALUES('$suppiler','$category',
					'$productName','$quantity','$newprice','$nowformat','$unique_image')";
					$result = $this->db->insert($query);

					if($result){
						
						echo '<script>alert("Thêm Sản Phẩm vào Kho thành công!")</script>';	
						echo '<script>window.location = "storage.php"</script>';
					}else{
						$alert = '<span class="error">Bạn đã thêm Sản Phẩm '  .$productName. '</span>' . '<span class="error"> Thất Bại </span>';
					}
				}
			}
		}

		public function show_storage()
		{
			$query = "SELECT tbl_storage.*, tbl_category.catName FROM tbl_storage INNER JOIN tbl_category ON tbl_storage.catId = tbl_category.catId order by tbl_storage.quantity DESC";
			$result = $this->db->insert($query);
			return $result;
		}

		public function show_pd_storage($id_pd_storage)
		{
			$query = "SELECT productName FROM tbl_storage WHERE Idproduct = '$id_pd_storage'";
			$result = $this->db->select($query);
			return $result;
		}

		
		public function show_storage_quatity($nameProduct)
		{
			$select_query = "SELECT * FROM tbl_storage WHERE tbl_storage.productName = '$nameProduct'";
			$result = $this->db->select($select_query);
			if($result)
			{
				// echo '<img src="admin/uploads/'. $result['image'];

				while($row = mysqli_fetch_array($result))
				{
					$data = [
						'Id' => $row['Idproduct'],
						'Supplier' => $row['supplier'],
						'CatId' => $row['catId'],
						'Productname' => $row['productName'],
						'Quantity' => $row['quantity'],
						'Importprice' => $row['import_price'],
						'Importdate' => $row['import_date'],
						'Image' => $row['image']
					];
				}
				header('Content-Type: application/json'); 

				echo json_encode($data);	
				// echo $image;			
			}
		}

		public function select_productin_storage_update($id_pd_storage, $quantity)
		{
			$select_query = "SELECT tbl_storage.quantity FROM tbl_storage WHERE Idproduct = '$id_pd_storage'";
			$result_query = $this->db->select($select_query);
			if($result_query)
			{
				while($row = mysqli_fetch_assoc($result_query))
				{
					$soluongtrongkho = $row['quantity'];
				}
				$soluong_conlai = $soluongtrongkho - $quantity;
				
				$query_update = "UPDATE tbl_storage SET quantity = '$soluong_conlai' WHERE Idproduct = '$id_pd_storage'";
				$result_update = $this->db->update($query_update);
			}
		}

		public function select_productin_storage($productName, $quantity)
		{
			$query = "SELECT tbl_storage.quantity FROM tbl_storage WHERE tbl_storage.productName = '$productName'";
			$result = $this->db->select($query);
			if($result)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					$soluongtrongkho = $row['quantity'];
				}

				$soluongconlai = $soluongtrongkho - $quantity;
				$query_update = "UPDATE tbl_storage SET quantity = '$soluongconlai' WHERE productName = '$productName'";
				$result_update = $this->db->update($query_update);
			}
		}

		// public function getproductstorage_byId($Id)
		// {
		// 	$select_query = "SELECT * FROM tbl_storage WHERE Idproduct = '$Id'";
		// 	$result_select = $this->db->select($select_query);
		// 	return $result_select;
		// }

		public function in_file_excel_nhapkho()
		{
			$query_export = "SELECT tbl_storage.*, tbl_category.catName FROM tbl_storage INNER JOIN tbl_category ON tbl_storage.catId = tbl_category.catId";
			$result_export = $this->db->select($query_export);
			if($result_export)
			{ 
				while($result = mysqli_fetch_array($result_export))
				{
					$result_array[] = $result;
					foreach($result_array as $result)
					{
						$IdProduct = $result['Idproduct'];
						$Supplier = $result['supplier'];
						$TypeProduct = $result['catName'];
						$ProductName = $result['productName'];
						$QuantityProduct = $result['quantity'];
						$ImportPrice = $result['import_price'];
						$ImportDate = $result['import_date'];
					}	
					$data[] = array('id_sp' => $IdProduct, 'supplier_sp' => $Supplier, 'loai_sp' => $TypeProduct, 'ten_sp' => $ProductName, 
					'sl_sp' => $QuantityProduct, 'gia_sp' => $ImportPrice, 'ngaynhap_sp' => $ImportDate);
				}
				header('Content-Type: application/json'); 
				echo json_encode($data);
			}
		}

		public function in_file_excel_nhapkho_homnay($nowformat)
		{
			$query_export = "SELECT tbl_storage.*, tbl_category.catName FROM tbl_storage INNER JOIN tbl_category ON tbl_storage.catId = tbl_category.catId 
			WHERE tbl_storage.import_date = '$nowformat'";
			$result_export = $this->db->select($query_export);
			if($result_export)
			{ 
				while($result = mysqli_fetch_array($result_export))
				{
					$result_array[] = $result;
					foreach($result_array as $result)
					{
						$IdProduct = $result['Idproduct'];
						$Supplier = $result['supplier'];
						$TypeProduct = $result['catName'];
						$ProductName = $result['productName'];
						$QuantityProduct = $result['quantity'];
						$ImportPrice = $result['import_price'];
						$ImportDate = $result['import_date'];
					}	
					$data[] = array('id_sp' => $IdProduct, 'supplier_sp' => $Supplier, 'loai_sp' => $TypeProduct, 'ten_sp' => $ProductName, 
					'sl_sp' => $QuantityProduct, 'gia_sp' => $ImportPrice, 'ngaynhap_sp' => $ImportDate);
				}
				header('Content-Type: application/json'); 
				echo json_encode($data);
			}
		}

		// public function search_recommend($suggest_export_sp)
		// {
		// 	$query_select = "SELECT tbl_storage.productName FROM tbl_storage WHERE productName LIKE '%$suggest_export_sp%'";
		// 	$result_select = $this -> db->select($query_select);
		// 	if($result_select)
		// 	{
		// 		while($result = mysqli_fetch_array($result_select))
		// 		{
		// 			$result_array[] = $result;
		// 			foreach($result_array as $result)
		// 			{
		// 				$ProductName = $result['productName'];
		// 			}	
		// 			$data = array('ten_sp' => $ProductName);

		// 			if(!empty($suggest_export_sp))
		// 			{
		// 				foreach ($data as $datas)
		// 				{
		// 					echo $datas;
		// 					echo "<br>";
		// 				}
		// 			}
		// 		}
		// 	}
		// }
    }
?>