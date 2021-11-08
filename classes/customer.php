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
			if($username=="" || $useracc=="" || $userpass==""){
				$alert = "<span class='error'>Các Trường không được để trống</span>";
				return $alert;
			} else {
				$check_user = "SELECT * FROM tbl_regis WHERE useracc = '$useracc' LIMIT 1";
				$result_check = $this->db->select($check_user);
				if($result_check)
				{
					$alert = "<span class='error'>,<center>Tên Tài Khoản này đã được sử dụng.</center></span>";
					return $alert;
				}
				else
				{

					$query = "INSERT INTO tbl_regis(username,useracc,userpass) VALUES('$username','$useracc',
					'$userpass')";
					$result = $this->db->insert($query);

					if($result){
						
						$alert = "<span class='successs'>,<center>Bạn Đã Đăng Ký Tạo Tài Khoản Thành Công. Chào mừng bạn đến với cửa hàng chúng tôi!</center></span>";
						
						return $alert;
					}else{
						$alert = "<span class='error'>,<center>Bạn Đã Đăng Ký Tạo Tài Khoản Thất Bại.</center></span>";
					}
				}
			}
		}

		public function login_customer($data)
		{
			$useracc = mysqli_real_escape_string($this->db->link, $data['User']);
			$userpass = mysqli_real_escape_string($this->db->link, $data['Pass']);
			if(empty($useracc) || empty($userpass)){
				$alert = "<span class='error'><center>Tài Khoản và Mật Khẩu không được để trống</center></span>";
				return $alert;
			} else {
				$check_user = "SELECT * FROM tbl_regis WHERE useracc = '$useracc' AND userpass = '$userpass' LIMIT 1";
				$result_check = $this->db->select($check_user);
				if($result_check != false)
				{
					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['regisId']);
					echo "<script>window.location = 'cart.php'</script>";
				}
				else
				{
					$alert = "<span class='error'><center>Tài Khoản và Mật Khẩu không trùng khớp.</center></span>";
					return $alert;
				}
			}
		}


	}

?>


