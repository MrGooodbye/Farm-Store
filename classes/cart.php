<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	
?>


<?php
	class cart
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function add_to_cart($quantity, $id){
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();

			
			$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
			$result_check_cart = $this->db->select($check_cart);

			if($result_check_cart){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào Giỏ Hàng</span>";
				return $msg;
			}else{

				$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$result = $this->db->select($query)->fetch_assoc();


				$image = $result["image"];
				$price = $result["price"];
				$productName = $result["productName"];

				$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image) VALUES('$id','$sId',
				'$productName','$price','$quantity','$image')";
				
				$insert_cart = $this->db->insert($query_insert);

					if($insert_cart){
					
						$msg = "<span class='error'>Thêm sản phẩm vào Giỏ Hàng thành công.</span>";
						return $msg;
					
							
					}
				 }
		}




		public function get_product_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_quantity_cart($quantity, $cartId){
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);

			$query = "UPDATE tbl_cart SET 
					quantity = '$quantity'
					WHERE cartId = '$cartId' ";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Giỏ Hàng của bạn đã được cập nhật Thành Công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Giỏ Hàng của bạn đã được cập nhật Thất Bại</span>";
				return $msg;
			}
		}


		public function del_product_cart($cartid){
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid' ";
			$result = $this->db->delete($query);
		}

		public function check_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}


		public function del_all_data_cart(){
			$sId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->delete($query);
		}



		public function getallorder(){
			$query = "SELECT * FROM tbl_order ";
			$result = $this->db->select($query);
			return $result;
		}



		public function del_order($Id){
			$query_del = "DELETE FROM tbl_order WHERE orderId = '$Id' ";
			$result_del = $this->db->delete($query_del);
			if($result_del){
					$alert = '<div class="success"><center>Bạn đã xác nhận Thành Công Đơn Đặt Hàng này!</center> </br></div>';		
					return $alert;
			}else{
					$alert = '<div class="error"><center>Bạn đã xác nhận Thất Bại Đơn Đặt Hàng này!</center></div>';
					return $alert;
				}
		}




		public function insert_order($data)
		{
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch_assoc()){
					$productid = $result['productId'];
					$productname = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'];
					$image = $result['image'];
			
					$hotenkhach = mysqli_real_escape_string($this->db->link, $data['hotenkhach']);
					$sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
					$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
					$thanhpho = mysqli_real_escape_string($this->db->link, $data['thanhpho']);
				}
					if(empty($hotenkhach) || empty($sdt) || empty($diachi) || empty($thanhpho))
					{
						$alert = "<span class='error'>Các Trường không được để trống</span>";
						return $alert;
					} else {
						$query_order = "INSERT INTO tbl_order(hotenkhach,sdt,diachi,thanhpho,productId,productName,quantity,price,image)
						VALUES('$hotenkhach','$sdt','$diachi','$thanhpho','$productid','$productname','$quantity','$price','$image')";
						$result = $this->db->insert($query_order);
					}
			}
		}
	}
?>




