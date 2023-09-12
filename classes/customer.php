<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	
?>

<?php
	class customer
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_customer($data)
		{	  
			$username = mysqli_real_escape_string($this->db->link, $data['username']);
			$useracc = mysqli_real_escape_string($this->db->link, $data['useracc']);
			$userpass = mysqli_real_escape_string($this->db->link, $data['userpass']);
			$pass = strlen($userpass);	
			$user = strlen($username);
			$acc = strlen($useracc);
			$check_user = "SELECT * FROM tbl_regis WHERE useracc = '$useracc' LIMIT 1";
			$result_check = $this->db->select($check_user);
			//TRƯỜNG HỢP KHÔNG NHẬP Ô TEXT NÀO
			if(empty($username) && empty($useracc) && empty($userpass)){
				$alert = "<span class='error'><center>Vui lòng nhập Tên Người Dùng, Tên Tài Khoản và Mật Khẩu!</center></span>";
				return $alert;
			}

			//TRƯỜNG HỢP NHẬP 3 Ô TEXT
			elseif($user < 10)
			{
				$alert = "<span class='error'><center>Độ dài Tên Người Dùng phải tối thiểu là 10 ký tự.</center></span>";
				return $alert;
			}

			elseif($user > 50)
			{
				$alert = "<span class='error'><center>Độ dài Tên Người Dùng chỉ được phép tối đa là 50 ký tự.</center></span>";
				return $alert;
			}

			elseif(preg_match('/[\'$%&*()}{@#~?><>,|=_+¬-]/', $username)) //bỏ ^£
			{
				$alert = "<span class='error'><center>Tên Người Dùng không được phép nhập ký tự đặc biệt.</center></span>";
				return $alert;
			}

			elseif(ctype_digit($username))
			{
				$alert = "<span class='error'><center>Tên Người Dùng không được phép nhập số.</center></span>";
				return $alert;
			}

			elseif($acc < 10)
			{
				$alert = "<span class='error'><center>Độ dài Tên Tài Khoản phải tối thiểu là 10 ký tự.</center></span>";
				return $alert;
			}

			elseif($acc > 30)
			{
				$alert = "<span class='error'><center>Độ dài Tên Tài Khoản chỉ được phép tối đa là 30 ký tự.</center></span>";
				return $alert;
			}

			else if($result_check)	
			{
				$alert = "<span class='error'><center>Tên Tài Khoản này đã được sử dụng. Vui lòng sử dụng Tên Tài Khoản khác!</center></span>";
				return $alert;
			}
			
			else if($pass < 6)
			{
				$alert = "<span class='error'><center>Độ dài Mật Khẩu của bạn phải tối thiểu là 6 ký tự. Vui lòng hãy thử một Mật Khẩu khác!</center></span>";
				return $alert;
			}

			else if($pass > 30)
			{
				$alert = "<span class='error'><center>Độ dài Mật Khẩu của bạn chỉ được phép tối đa là 30 ký tự. Vui lòng hãy thử một Mật Khẩu khác!</center></span>";
				return $alert;
			}

			//TH4: Thỏa tất cả điều kiện trênx
			//TỔNG CỘNG 16 TRƯỜNG HỢP
			else
			{
				$query = "INSERT INTO tbl_regis(username,useracc,userpass) VALUES('$username','$useracc','$userpass')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='successs'><center>Bạn Đã Đăng Ký Tạo Tài Khoản Thành Công. Chào mừng bạn đến với cửa hàng chúng tôi!<a href='index.php'> Nhấn vào đây để quay về Trang Chủ.</a></center></span>";
						return $alert;
				}
				else
				{
					$alert = "<span class='error'>,<center>Bạn Đã Đăng Ký Tạo Tài Khoản Thất Bại.</center></span>";
				}
			}
			
		}
		
 
		public function login_customer($data)
		{
			$useracc = mysqli_real_escape_string($this->db->link, $data['User']);
			$userpass = mysqli_real_escape_string($this->db->link, $data['Pass']);
			//TRƯỜNG HỢP KHÔNG NHẬP Ô TEXT NÀO -> Vui lòng nhập Tài Khoản và Mật Khẩu
			if(empty($useracc) && empty($userpass)){
				$alert = "<span class='error'><center>Vui lòng nhập Tài Khoản và Mật Khẩu!</center></span>";
				return $alert;
			} 

			//TRƯỜNG HỢP NHẬP 1 Ô TEXT
			//TH1: Nhập ô mật khẩu và để trống tài khoản -> vui lòng nhập tài khoản
			else if($useracc=="")
			{
				$alert = "<span class='error'><center>Vui lòng nhập Tài Khoản!</center></span>";
				return $alert;
			} 
			//TH2: Nhập ô tài khoản và để trống mật khẩu -> vui lòng nhập mật khẩu
			else if($userpass=="")
			{
				$alert = "<span class='error'><center>Vui lòng nhập Mật Khẩu!</center></span>";
				return $alert;
			}
			
			//TRƯỜNG HỢP NHẬP 2 Ô TEXT
			//TH2: Thỏa tất cả các trường hợp trên
			else {
				$check_user = "SELECT * FROM tbl_regis WHERE useracc = '$useracc' AND userpass = '$userpass' LIMIT 1";
				$result_check = $this->db->select($check_user);
				if($result_check != false)
				{
					$value = $result_check->fetch_assoc();
					echo $userpass;
					Session::set('customer_login',true);
					Session::set('customer_id',$value['regisId']);
					echo '<script>alert("Bạn đã đăng nhập thành công!")</script>';
					echo "<script>window.location = 'cart.php#giohangf'</script>";
				}
				//TH1: Nhập sai tài khoản hoặc mật khẩu -> Tài Khoản hoặc Mật Khẩu không chính xác
				else
				{
					echo $userpass;
					echo '<script>alert("Sai thông tin tài khoản hoặc mật khẩu!")</script>';
				}
			}
		}

		public function show_customers($id)
		{
			$query = "SELECT * FROM tbl_regis WHERE regisId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_customers($data,$files,$idd)
		{
			$username = mysqli_real_escape_string($this->db->link, $data['username']);
			$sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
			$cmnd = mysqli_real_escape_string($this->db->link, $data['cmnd']);
			$gioitinh = mysqli_real_escape_string($this->db->link, $data['gioitinh']);
			$ngaysinh = mysqli_real_escape_string($this->db->link, $data['ngaysinh']);
			$dob = date('Y-m-d', strtotime($ngaysinh));
			$user = strlen($username);
			$string = strlen($sdt);
			$address = strlen($diachi);
			$cccd = strlen($cmnd);

			$sdt_md5 = md5($sdt);
			$cmnd_md5 = md5($cmnd);

			$permited  = array('jpg', 'jpeg', 'png');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			
			$div = explode('.', $file_name); //explode dùng để chia cắt phần tên và đuôi của file ra thành 2 phần tách biệt thông qua dấu .
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; //substring là hàm random số từ 0 -> 10 kết hợp với tên file_ext để tạo thành tên mới và thêm vào csdl
			$uploaded_image = 'avt/'.$unique_image;
			 
			//TRƯỜNG HỢP KHÔNG NHẬP Ô TEXT NÀO
			if(empty($sdt) || empty($email) || empty($diachi) || empty($cmnd)){
				$alert = "<span class='error'><center>Vui lòng nhập đầy đủ các trường thông tin.</center></span> <br>";
				return $alert;
			}

			else
			{
				if(!empty($file_name))
				{
					// nếu người dùng chọn ảnh hoặc không sửa ảnh đã tồn tại trong csdl
					if($file_size < 2048) 	
					{
						 $alert = "<span class='error'>Kích Thước Ảnh không được vượt quá 2MB!</span>";
						 return $alert;
					}
					elseif (in_array($file_ext, $permited) === false) 
					{
						$alert = "<span class='error'><center>Bạn chỉ có thể chọn flie ảnh theo định dạng: ".implode(', ', $permited)."</center></span> <br>";
						return $alert;
					}

					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_regis SET 
					username = '$username', 
					sdt= '$sdt_md5', 
					email = '$email', 
					diachi = '$diachi', 
					cmnd = '$cmnd_md5', 
					gioitinh = '$gioitinh', 
					ngaysinh = '$dob', 
					image = '$unique_image' 

					WHERE regisId='$idd'";
				}

				else
				{
					//nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_regis SET 
					username = '$username', 
					sdt= '$sdt', 
					email = '$email', 
					diachi = '$diachi', 
					cmnd = '$cmnd_md5', 
					gioitinh = '$gioitinh', 
					ngaysinh = '$dob'

					WHERE regisId='$idd'";				
				}

			}

			

			$result = $this->db->insert($query);
			if($result){
				echo '<script>alert("Bạn đã cập nhật thông tin thành công!")</script>';
			}

			else
			{
				echo '<script>alert("Bạn đã cập nhật thông tin thất bại!")</script>';
			}
		}

		public function verify_otp_mobile($id_acc_changepass)
		{
			$query_select_mobilephone = "SELECT tbl_regis.sdt FROM tbl_regis WHERE regisId = $id_acc_changepass";
			$result_select = $this->db->select($query_select_mobilephone);
			if($result_select)
			{
				while($row = mysqli_fetch_assoc($result_select))
				{
					$sdt = $row['sdt'];
				}
			}
		}

		public function update_pw($data,$idd)
		{
			$pass = mysqli_real_escape_string($this->db->link, $data['userpass']);
			$repass = mysqli_real_escape_string($this->db->link, $data['sdt']);
			$pass1 = strlen($pass);
			$pass2 = strlen($repass);
			if(empty($pass) || empty($repass)){
				$alert = "<span class='error'><center>Vui lòng nhập đầy đủ các trường mật khẩu.</center></span> <br>";
				return $alert;
			}
			elseif($pass != $repass)
			{
				$alert_gg = '<span class="error"><center>Mật khẩu nhập lại không khớp</center></span><br>';
					return $alert_gg;
			}
			else
			{
				$query = "UPDATE tbl_regis SET userpass = '$pass' WHERE regisId='$idd'";
				$result = $this->db->insert($query);
				if($result){
					echo '<script>alert("Bạn đã thay đổi mật khẩu thành công!")</script>';
				}
				else
				{
					echo '<script>alert("Bạn đã thay đổi mật khẩu thất bại!")</script>';
				}
			}
		}

		public function show_order($id)
		{
			$query = "
			SELECT tbl_order.orderId, tbl_order.productName, tbl_order.price, tbl_order.quantity, tbl_order.image, tbl_order.paid_date, 
			tbl_order.paid_type, tbl_order.status, tbl_order.sale
			FROM tbl_order WHERE regisId = '$id'
			UNION
			SELECT tbl_cartonline.cart_online_Id, tbl_cartonline.productName, tbl_cartonline.price, tbl_cartonline.quantity, tbl_cartonline.image, 
			tbl_cartonline.paid_date, tbl_cartonline.paid_type, tbl_cartonline.status, tbl_cartonline.sale
			FROM tbl_cartonline WHERE regisId = '$id'
			ORDER BY paid_date";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_order_details($order_id, $paid_type)
		{
			$query = "
			SELECT tbl_order.productName, tbl_order.quantity, tbl_order.price, tbl_order.image, tbl_order.paid_date, tbl_order.paid_type, 
			tbl_order.hotenkhach, tbl_order.sdt, tbl_order.diachi, tbl_order.status
			FROM tbl_order WHERE tbl_order.orderId  = '$order_id' AND paid_type = '$paid_type'
			UNION
			SELECT tbl_cartonline.productName, tbl_cartonline.quantity, tbl_cartonline.price, tbl_cartonline.image, tbl_cartonline.paid_date, 
			tbl_cartonline.paid_type, tbl_cartonline.hovaten, tbl_cartonline.sdt, tbl_cartonline.diachi, tbl_cartonline.status
			FROM tbl_cartonline WHERE tbl_cartonline.cart_online_Id = '$order_id' AND paid_type = '$paid_type'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_all_customer()
		{
			$query_select = "SELECT * FROM tbl_regis";
			$result_select = $this->db->select($query_select);
			return $result_select;
		}

		public function show_user_details($user_id)
		{
			$query = "SELECT * FROM tbl_regis WHERE regisId = '$user_id'";
			$result_query = $this->db->select($query);
			return $result_query;
		}
	}
?>


