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
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$suppiler = mysqli_real_escape_string($this->db->link, $data['supplier']);
			$quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
			$price = mysqli_real_escape_string($this->db->link, $data['import_price']);

			$newprice = $this->fm->RemoveSpecialCharSpace($price);

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
					$alert = '<span class="error">Sản Phẩm này đã được thêm vào. Vui lòng kiểm tra lại!</span';
					return $alert;
				}
				else
				{
					$now = Carbon::now('Asia/Ho_Chi_Minh');
					$nowformat = $now->isoFormat('DD/MM/YYYY');

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
			$query = "SELECT * FROM tbl_storage";
			$result = $this->db->insert($query);
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

		public function select_productin_storage_update($product_name, $quantity)
		{
			$select_query = "SELECT tbl_storage.quantity FROM tbl_storage WHERE productName = '$product_name'";
			$result_query = $this->db->select($select_query);
			if($result_query)
			{
				while($row = mysqli_fetch_assoc($result_query))
				{
					$soluongtrongkho = $row['quantity'];
				}
				$soluong_conlai = $soluongtrongkho - $quantity;
				
				$query_update = "UPDATE tbl_storage SET quantity = '$soluong_conlai'";
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

    }
?>