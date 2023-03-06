<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	include_once "storage.php";
	require ($filepath."/../carbon/autoload.php");
    use Carbon\Carbon;
	use Carbon\CarbonInterval;
?>

<?php
	class product
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_product($data,$files)
		{	
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
			
			$now = Carbon::now('Asia/Ho_Chi_Minh');
			$nowformat = $now->isoFormat('DD/MM/YYYY');
			
			$newprice = $this->fm->RemoveSpecialCharSpace($price);

			$string = strlen((string)$newprice);
		
			//TRƯỜNG HỢP KHÔNG NHẬP Ô TEXT NÀO
			if(empty($productName) && empty($category) && empty($product_desc) && empty($type) && empty($price) && empty($quantity))
			{
				$alert = "<span class='error'>Vui lòng nhập Tên Sản Phẩm, Loại Sản Phẩm, Mô Tả, Giá Bán, chèn Ảnh, Danh Mục của Sản Phẩm!</span>";
				return $alert;
			}

			else {
				
				$check_cat = "SELECT * FROM tbl_product WHERE productName = '$productName' LIMIT 1";
				$result_check = $this->db->select($check_cat);
				if($result_check)
				{
					while($row = mysqli_fetch_assoc($result_check))
					{
						$product_id = $row['productId'];
						$product_name = $row['productName'];
						$soluong_from_storage = $row['solg_from_storage'];
					}
					$soluong_congthem = $soluong_from_storage + $quantity;
					$query = "UPDATE tbl_product SET catId = '$category', product_desc = '$product_desc', type = '$type', price = '$price', solg_from_storage = '$soluong_congthem', export_date = '$nowformat' WHERE productId = '$product_id' AND productName = '$product_name'";
					$result_query = $this->db->update($query);
					if($result_query)
					{
						$storage = new storage();
						echo '<script>alert("Đã cập nhật Sản Phẩm ra bán thành công!")</script>';
						$storage->select_productin_storage_update($product_name, $quantity);
					}
				}
				
				else
				{
					if(empty($files))
					{
						echo '<script>alert("Bạn chưa chọn ảnh cho sản phẩm!)</script>';
					}

					else
					{
						$check = @getimagesize($_FILES['image']['tmp_name']);
			
						//kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
						$permited  = array('jpg', 'jpeg', 'png');
						$file_name = $_FILES['image']['name'];
						$file_size = $_FILES['image']['size'];
						$file_temp = $_FILES['image']['tmp_name'];
						

						$maxsize = 1024 * 1024;
						$div = explode('.', $file_name);
						$file_ext = strtolower(end($div));
						$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
						$uploaded_image = "uploads/".$unique_image;

						if($file_size > $maxsize)
						{
							$alert = "<span class='error'>Ảnh được chọn không được vượt quá 2MB!</span>";
							return $alert;
						}

						elseif(in_array($file_ext, $permited) == false) 
						{
							$alert = "<span class='error'>Bạn chỉ có thể chọn loại ảnh có định dạng là: ".implode(', ', $permited)."</span>";
							return $alert;
						}

						elseif($check == false)
						{
							$alert = '<span class="error">Vui lòng chọn ảnh hợp lệ.</span';
							return $alert;
						}

						else
						{
							move_uploaded_file($file_temp, $uploaded_image); //dùng để lấy tên của file hình ảnh tạm đó để gửi vào $file_temp sau đó upload vào folder uploads
							

							$query = "INSERT INTO tbl_product(productName,catId,product_desc,type,price,image,solg_from_storage,export_date) VALUES('$productName','$category',
							'$product_desc','$type','$newprice','$unique_image','$quantity','$nowformat')";
							$result = $this->db->insert($query);

							if($result)
							{
								$storage = new storage();	
								echo '<script>alert("Thêm Sản Phẩm ra bán thành công!")</script>';
								echo $storage->select_productin_storage($productName, $quantity);
							}

							else
							{
								echo '<script>alert("Thêm Sản Phẩm ra bán thất bại!")</script>';
							}
						}
					}
				}
			}
		}

		public function show_product()
		{

			$query = "
			SELECT tbl_product.*, tbl_category.catName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			order by tbl_product.solg_from_storage desc";
			$result = $this->db->select($query);
			return $result;
		}


		public function getproductbyId($Id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$Id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_product($data,$files,$Id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			
			//kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name); //explode dùng để chia cắt phần tên và đuôi của file ra thành 2 phần tách biệt thông qua dấu .
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; //substring là hàm random số từ 0 -> 10 kết hợp với tên file_ext để tạo thành tên mới và thêm vào csdl
			$uploaded_image = "uploads/".$unique_image;

	
			if($productName=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Các Trường không được để trống</span>";
				return $alert;
			} else {
						if(!empty($file_name)){
							//nếu người dùng chọn ảnh hoặc không sửa ảnh đã tồn tại
							if($file_size < 2048) {
							 	$alert = "<span class='error'>Kích Thước Ảnh không được vượt quá 2MB!</span>";
							 	return $alert;
							}
							elseif (in_array($file_ext, $permited) === false) 
							{
								//echo "<span class='error'>Bạn chỉ có thể được tải lên:-".implode(', ', $permited)."</span>";
								$alert = "<span class='error'>Bạn chỉ có thể chọn flie theo định dạng: ".implode(', ', $permited)."</span>";
								return $alert;
							}
							
							move_uploaded_file($file_temp,$uploaded_image);
							$query = "UPDATE tbl_product SET 
							productName = '$productName',
							catId = '$category',
							product_desc = '$product_desc',
							type = '$type',
							price = '$price',
							image = '$unique_image'

							WHERE productId = '$Id'";

				   		}else{
				   			//nếu người dùng không chọn ảnh
				   			$query = "UPDATE tbl_product SET 
							productName = '$productName',
							catId = '$category',
							product_desc = '$product_desc',
							type = '$type',
							price = '$price'
							WHERE productId = '$Id'";

				   		}
				   	}


				$result = $this->db->update($query);
				if($result){
					
					echo '<script>alert("Bạn đã sửa thành công sản phẩm ' . $productName .'! ")</script>';
					echo '<script>window.location = "produclist.php"</script>';
				}else{
					echo '<script>alert("Bạn đã sửa thành công sản phẩm ' . $productName .'! ")</script>';
					echo '<script>window.location = "produclist.php"</script>';
				}
			}
		
		

		public function del_product($Id){
			$query = "DELETE FROM tbl_product WHERE productId = '$Id'";
			$result = $this->db->delete($query);
			if($result){
					
					$alert = '<span class="success">Bạn đã xoá Thành Công sản phẩm này</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã xóa Thất Bại sản phẩm này </span>';
					return $alert;
				}
			}

		public function getproduct_featured(){
			$query = "SELECT * FROM tbl_product WHERE type = '1'";
			$result = $this->db->select($query);
			return $result;
		}


		public function get_details($id){
			$query = "
			SELECT tbl_product.*, tbl_category.catName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			WHERE tbl_product.productId = '$id' ";

			$result = $this->db->select($query);
			return $result;
		}


		public function getallproduct(){
			$query = "SELECT * FROM tbl_product ";
			$result = $this->db->select($query);
			return $result;
		}

		public function searchproduct($tukhoa)
		{
			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'"; 
			$result = $this->db->select($query);
			return $result;
		}

		public function searchbycatproduct($id,$tukhoa)
		{
			// $query = "SELECT tbl_product.productId, tbl_product.productName, tbl_product.catId, tbl_product.product_desc, tbl_product.type, tbl_product.price, tbl_product.image
			// FROM tbl_product
			// LEFT JOIN tbl_category
			// ON tbl_product.catId = tbl_category.catId 
			// WHERE tbl_category.catId = '$catid' AND tbl_product.productName LIKE '%$tukhoa%'";
			//------------- LEFT JOIN

			$query = "SELECT * FROM tbl_product WHERE tbl_product.catId = '$id'
			AND tbl_product.productname LIKE '%".$tukhoa."%'";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkquantity($check_pd)
		{
			$query = "SELECT tbl_product.solg_from_storage FROM tbl_product WHERE tbl_product.productId = '$check_pd'";
			$result = $this->db->select($query);
			if($result)
			{
				while($row = mysqli_fetch_array($result))
				{
					$data = [
						'Quantity' => $row['solg_from_storage']
					];
				}
				header('Content-Type: application/json'); 
				echo json_encode($data);
			}
		}

		public function check_plus_quantity($Product_Id)
		{
			
			$query_select = "SELECT tbl_product.solg_from_storage FROM tbl_product WHERE productId = '$Product_Id'";
			$result_select = $this->db->select($query_select);
			if($result_select)
			{
				while($row = mysqli_fetch_assoc($result_select))
				{
					$soluong_dangban = $row['solg_from_storage'];
				}
				echo $soluong_dangban;
			}
		}

		public function check_change_quantity($Id_Product)
		{
			$query_select = "SELECT tbl_product.solg_from_storage FROM tbl_product WHERE productId = '$Id_Product'";
			$result_select = $this->db->select($query_select);
			if($result_select)
			{
				while($row = mysqli_fetch_assoc($result_select))
				{
					$soluong_dangban = $row['solg_from_storage'];
				}
				echo $soluong_dangban;
			}
		}

		public function in_file_excel()
		{			
			$query_export = "SELECT * FROM tbl_product ORDER BY export_date";
			$result_export = $this->db->select($query_export);
			if($result_export)
			{ 
				while($result = mysqli_fetch_array($result_export))
				{
					$result_array[] = $result;
					foreach($result_array as $result)
					{
						$TenSanPham = $result['productName'];
						$SoLuongSanPham = $result['solg_from_storage'];
						$LoaiSanPham = $result['catId'];
						$MotaSanPham = $result['product_desc'];
						$DanhMucSanPham = $result['type'];
						$GiaSanPham = $result['price'];
						$NgayXuatSanPham = $result['export_date'];
					}	
					$data[] = array(
						'ten_sp' => $TenSanPham, 'sl_sp' => $SoLuongSanPham, 'loai_sp' => $LoaiSanPham, 'mota_sp' => $MotaSanPham, 
						'danhmuc_sp' => $DanhMucSanPham, 'gia_sp' => $GiaSanPham, 'ngayxuat_sp' => $NgayXuatSanPham
					);
				}

				// header('Content-Encoding: utf-8');
				// header('Content-Type: text/csv; charset=utf-8');
				 
				// Excel file name for download 
				$filename = "Xuat-Kho-Ngay-" . date('d-m-Y') . ".csv"; 

				header('Content-Type: text/csv; charset=utf-8');
    			header('Content-Disposition: attachment; filename="'.$filename.'";');

				// $fp = fopen($filename, 'w' ); //mở = fileName để xem data
				$fp = fopen('php://output', 'w' ); //mở = browser để xem data, phải có exit khi kết thúc
				// fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

				// Column names 
				$headers = array('Tên Sản Phẩm', 'Số Lượng Đang Bán', 'Loại Sản Phẩm', 'Mô Tả', 'Danh Mục Sản Phẩm', 'Đơn Giá', 'Ngày Xuất Kho'); 

				fputcsv($fp, $headers);
				
				
				foreach($data as $datas)
				{
					fputcsv($fp, $datas);
				}

				
				fclose($fp);
				exit;

			}

			else
			{ 
					
			} 

		}
	}
?>


