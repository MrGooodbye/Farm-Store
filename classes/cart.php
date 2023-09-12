<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	require ($filepath."/../carbon/autoload.php");
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
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
		
		public function add_to_cart($quantity, $id)
		{
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();
			$code_cart = rand(0, 9999);
			
			$check_cart = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result_check_cart = $this->db->select($check_cart);

			//kiểm tra sản phẩm trong giỏ hàng qua session
			if($result_check_cart == true)
			{
				$disable_key = "SET FOREIGN_KEY_CHECKS = 0";
                $result_disable = $this->db->insert($disable_key);
            
                if($result_disable)
                {
					while ($result = $result_check_cart->fetch_assoc())
					{
						$current_sId = $result['sId'];
						$current_code_cart = $result['code_cart_online'];
					}

					$query = "SELECT * FROM tbl_product WHERE productId = '$id'";		
					$get_product = $this->db->select($query);

					if($get_product)
					{
						while($result = $get_product->fetch_assoc())
						{
							$productid = $result["productId"];
							$image = $result["image"];
							$price = $result["price"];
							$productName = $result["productName"];
							$solg_frm_storage = $result["solg_from_storage"];
							$sale = $result["sale"];
							$sale_duration = $result["sale_duration"];
						}

						//nếu trong giỏ đã có sản phẩm trùng với idproduct từ tbl_product -> sẽ cộng dồn số lượng lại
						$query_check_cart_pd = "SELECT * FROM tbl_cart WHERE sId = '$sId' AND productId = '$id'";
						$result_check_cart_pd = $this->db->select($query_check_cart_pd);
						if($result_check_cart_pd == true)
						{
							while($result_check_product = $result_check_cart_pd->fetch_assoc())
								{
									$soluong_trong_giohang = $result_check_product["quantity"];
								}

							$soluong_caphhat_lai = $soluong_trong_giohang + $quantity;

							if($solg_frm_storage >= $soluong_caphhat_lai)
							{
								$query_update_cart_pd = "UPDATE tbl_cart SET quantity = '$soluong_caphhat_lai' WHERE sId = '$sId' AND productId = '$id'";
								$result_update_cart_pd = $this->db->update($query_update_cart_pd);
								if($result_update_cart_pd)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<br><span class='successs'>Thêm Sản phẩm vào Giỏ Hàng thành công</span>";
										return $msg;
									}
								}
							}
							else
							{
								$msg = "<span class='error'>Số lượng hiện tại không thể lớn hơn số lượng chúng tôi đang bán!</span>";
								return $msg;
							}
						}

						//nếu trong giỏ không có sản phẩm trùng với idproduct từ tbl_product và trong giỏ hàng đã tồn tại 1 sp -> sẽ lấy code_cart_online từ sp đó
						else
						{
							if($sale == 0)
							{
								$query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image, code_cart_online) 
								VALUES('$id', '$current_sId', '$productName', '$price', '$quantity', '$image', '$current_code_cart')";
									
								$result_insert = $this->db->insert($query_insert);
								if($result_insert)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<br><span class='successs'>Thêm Sản phẩm vào Giỏ Hàng thành công</span>";
										return $msg;
									}
								}
							}

							else
							{
								$query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image, code_cart_online, sale, duration) 
								VALUES('$id', '$current_sId', '$productName', '$price', '$quantity', '$image', '$current_code_cart', '$sale', '$sale_duration')";
									
								$result_insert = $this->db->insert($query_insert);
								if($result_insert)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<br><span class='successs'>Thêm Sản phẩm vào Giỏ Hàng thành công</span>";
										return $msg;
									}
								}	
							}		
						}
					}
				}
			}

			else
			{
				$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$get_product = $this->db->select($query);

				if($get_product)
				{
					while($result = $get_product->fetch_assoc())
					{
						$image = $result["image"];
						$price = $result["price"];
						$productName = $result["productName"];
						$sale = $result["sale"];
						$sale_duration = $result["sale_duration"];
					}

					if($sale == 0)
					{
						$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image,code_cart_online) 
						VALUES('$id','$sId','$productName','$price','$quantity','$image','$code_cart')";
					
						$result_insert = $this->db->insert($query_insert);
						if($result_insert)
						{
							$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
							$result_enable = $this->db->insert($enable_key);
							if($result_enable)
							{
								$msg = "<br><span class='successs'>Thêm Sản phẩm vào Giỏ Hàng thành công</span>";
								return $msg;
							}
						}
					}
					else
					{
						$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image,code_cart_online, sale, duration) 
						VALUES('$id','$sId','$productName','$price','$quantity','$image','$code_cart', '$sale', '$sale_duration')";
					
						$result_insert = $this->db->insert($query_insert);
						if($result_insert)
						{
							$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
							$result_enable = $this->db->insert($enable_key);
							if($result_enable)
							{
								$msg = "<br><span class='successs'>Thêm Sản phẩm vào Giỏ Hàng thành công</span>";
								return $msg;
							}
						}
					}
				}	
			}
		}

		public function add_to_cartt($quantity, $id){
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();
			$code_cart = rand(0, 9999);
			
			$check_cart = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result_check_cart = $this->db->select($check_cart);

			//kiểm tra sản phẩm trong giỏ hàng qua session
			if($result_check_cart == true)
			{
				$disable_key = "SET FOREIGN_KEY_CHECKS = 0";
                $result_disable = $this->db->insert($disable_key);
            
                if($result_disable)
                {
					while ($result = $result_check_cart->fetch_assoc())
					{
						$current_sId = $result['sId'];
						$current_code_cart = $result['code_cart_online'];
					}

					$query = "SELECT * FROM tbl_product WHERE productId = '$id'";		
					$get_product = $this->db->select($query);

					if($get_product)
					{
						while($result = $get_product->fetch_assoc())
						{
							$productid = $result["productId"];
							$image = $result["image"];
							$price = $result["price"];
							$productName = $result["productName"];
							$solg_frm_storage = $result["solg_from_storage"];
							$sale = $result["sale"];
							$sale_duration = $result["sale_duration"];
						}

						//nếu trong giỏ đã có sản phẩm trùng với idproduct từ tbl_product -> sẽ cộng dồn số lượng lại
						$query_check_cart_pd = "SELECT * FROM tbl_cart WHERE sId = '$sId' AND productId = '$id'";
						$result_check_cart_pd = $this->db->select($query_check_cart_pd);
						if($result_check_cart_pd == true)
						{
							while($result_check_product = $result_check_cart_pd->fetch_assoc())
								{
									$soluong_trong_giohang = $result_check_product["quantity"];
								}

							$soluong_caphhat_lai = $soluong_trong_giohang + $quantity;

							if($solg_frm_storage >= $soluong_caphhat_lai)
							{
								$query_update_cart_pd = "UPDATE tbl_cart SET quantity = '$soluong_caphhat_lai' WHERE sId = '$sId' AND productId = '$id'";
								$result_update_cart_pd = $this->db->update($query_update_cart_pd);
								if($result_update_cart_pd)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<script>window.location = 'cart.php#giohangf'</script>";
										return $msg;
									}
								}
							}
							else
							{
								$msg = "<span class='error'>Số lượng hiện tại không thể lớn hơn số lượng chúng tôi đang bán!</span>";
								return $msg;
							}
						}

						//nếu trong giỏ không có sản phẩm trùng với idproduct từ tbl_product và trong giỏ hàng đã tồn tại 1 sp -> sẽ lấy code_cart_online từ sp đó
						else
						{
							if($sale == 0)
							{
								$query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image, code_cart_online) 
								VALUES('$id', '$current_sId', '$productName', '$price', '$quantity', '$image', '$current_code_cart')";
									
								$result_insert = $this->db->insert($query_insert);
								if($result_insert)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<script>window.location = 'cart.php#giohangf'</script>";
										return $msg;
									}
								}
							}

							else
							{
								$query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image, code_cart_online, sale, duration) 
								VALUES('$id', '$current_sId', '$productName', '$price', '$quantity', '$image', '$current_code_cart', '$sale', '$sale_duration')";
									
								$result_insert = $this->db->insert($query_insert);
								if($result_insert)
								{
									$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
									$result_enable = $this->db->insert($enable_key);
									if($result_enable)
									{
										$msg = "<script>window.location = 'cart.php#giohangf'</script>";
										return $msg;
									}
								}	
							}		
						}
					}
				}
			}
			
			else
			{
				$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$get_product = $this->db->select($query);

				if($get_product)
				{
					while($result = $get_product->fetch_assoc())
					{
						$image = $result["image"];
						$price = $result["price"];
						$productName = $result["productName"];
						$sale = $result["sale"];
						$sale_duration = $result["sale_duration"];
					}

					if($sale == 0)
					{
						$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image,code_cart_online) 
						VALUES('$id','$sId','$productName','$price','$quantity','$image','$code_cart')";
					
						$result_insert = $this->db->insert($query_insert);
						if($result_insert)
						{
							$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
							$result_enable = $this->db->insert($enable_key);
							if($result_enable)
							{
								$msg = "<script>window.location = 'cart.php#giohangf'</script>";
								return $msg;
							}
						}
					}
					else
					{
						$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image,code_cart_online, sale, duration) 
						VALUES('$id','$sId','$productName','$price','$quantity','$image','$code_cart', '$sale', '$sale_duration')";
					
						$result_insert = $this->db->insert($query_insert);
						if($result_insert)
						{
							$enable_key = "SET FOREIGN_KEY_CHECKS = 1";
							$result_enable = $this->db->insert($enable_key);
							if($result_enable)
							{
								$msg = "<script>window.location = 'cart.php#giohangf'</script>";
								return $msg;
							}
						}
					}
				}	
			}
		}

		public function get_product_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_minus_quantity($Id_Cart, $Sl_conlai)
		{
			$query_update = "UPDATE tbl_cart SET quantity = $Sl_conlai WHERE cartId = '$Id_Cart'";
			$result = $this->db->update($query_update);
		}

		public function update_add_quantity($Cart_Id, $Sl_Tang)
		{
			$query_update = "UPDATE tbl_cart SET quantity = $Sl_Tang WHERE cartId = '$Cart_Id'";
			$result = $this->db->update($query_update);
		}

		public function update_change_quantity($GioHang_Id, $SoLuong_Moi)
		{
			$query_update = "UPDATE tbl_cart SET quantity = $SoLuong_Moi WHERE cartId = '$GioHang_Id'";
			$result = $this->db->update($query_update);
		}


		public function del_product_cart($cartid){
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);

			$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid' ";
			$result = $this->db->delete($query);
			if($result)
			{
				echo '<script>alert("Giỏ hàng đã được cập nhật!")</script>';
				return $result;
				
			}
			else
			{
				echo '<script>alert("Cập nhật Giỏ hàng thất bại!")</script>';
			}
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
			$query = "SELECT * FROM tbl_order WHERE status = 1 ORDER BY paid_date";
			$result = $this->db->select($query);
			return $result;
		}

		public function confirm_cart($id){
			$now = Carbon::now('Asia/Ho_Chi_Minh');
            $nowformat = $now->isoFormat('DD/MM/YYYY');
			$query = "UPDATE tbl_order SET
					status = '3', confirm_date = '$nowformat'
					WHERE orderId = '$id'";
			$result = $this->db->update($query);
		}

		public function giaohang($id_giao){
			$query = "UPDATE tbl_order SET
					status = '2'
					WHERE orderId = '$id_giao'";
			$result = $this->db->update($query);
			if($result){
					echo '<script>alert("Xử lý thành công, đơn hàng này sẽ được vận chuyển!!")</script>';
					echo '<script>window.location = "dathang.php"</script>';
			}else{
					$alert = '<div class="error"><center>Bạn đã xử lý Thất Bại Đơn Đặt Hàng này!</center></div>';
					return $alert;
				}
		}

		public function insert_order($data, $customer_id)
		{
			$hotenkhach = mysqli_real_escape_string($this->db->link, $data['hotenkhach']);
			$sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
			$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
			$hoten = strlen($hotenkhach);
			$string = strlen($sdt);
			$address = strlen($diachi);

			//TRƯỜNG HỢP KHÔNG NHẬP Ô TEXT NÀO
			if(empty($hotenkhach) && empty($sdt) && empty($diachi) && empty($thanhpho))
			{
				$alert_gg = '<span class="error"><center>Thông Tin Giao Hàng không được để trống!</center></span><br>';
				return $alert_gg;
			}

			//TRƯỜNG HỢP NHẬP 4 Ô TEXT
			else
			{	
				$now = Carbon::now('Asia/Ho_Chi_Minh');
				$nowformat = $now->isoFormat('DD/MM/YYYY');
				$paid_type = "Tiền Mặt";

				$sId = session_id();
				$disable_key = "SET FOREIGN_KEY_CHECKS = 0";
            	$result_disable = $this->db->insert($disable_key);
            
            	if($result_disable)
				{
					// echo '<script>alert("1")</script>';
					$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
					$get_product = $this->db->select($query);
					if($get_product)
					{	
						while($result = $get_product->fetch_assoc())
						{
							$cartId = $result['cartId'];
							$productid = $result['productId'];
							$productname = $result['productName'];
							$quantity = $result['quantity'];
							$sale = $result['sale'];
							$price = $result['price'] * $quantity;
							$image = $result['image'];
							$code_cart = $result['code_cart_online'];
							

							$add_to_cart_access = "INSERT INTO tbl_cart_access(cartId,sId,productId,productName,quantity,price,image,code_cart_online,paid_type,paid_date_time,regisId) 
							VALUES ('$cartId','$sId','$productid','$productname','$quantity','$price','$image','$code_cart','$paid_type','$now','$customer_id')";
							$result_add_to_cart_access = $this->db->insert($add_to_cart_access);
						
							$query_order = "INSERT INTO tbl_order(hotenkhach,sdt,diachi,productId,productName,quantity,price,image,paid_date,regisId,paid_type,sale)
							VALUES('$hotenkhach','$sdt','$diachi','$productid','$productname','$quantity','$price','$image','$nowformat','$customer_id','$paid_type','$sale')";
							$result_add = $this->db->insert($query_order);
								
							$query_select = "SELECT * FROM tbl_product WHERE productId = '$productid'";
							$result_select = $this->db->select($query_select);
							if($result_select)
							{
								while($row = mysqli_fetch_assoc($result_select))
								{
									$soluong_hientai = $row['solg_from_storage'];
									$soluong_conlai = $soluong_hientai - $quantity;

									$query_update = "UPDATE tbl_product SET solg_from_storage = '$soluong_conlai' 
									WHERE productId = '$productid'";
											
									$result_update = $this->db->update($query_update);
								}
							}
						}
						
						$query_del = "DELETE FROM tbl_cart WHERE sId = '$sId'";
						$result_del = $this->db->delete($query_del);
						if($result_del)
                        {
                            $enable_key = "SET FOREIGN_KEY_CHECKS = 1";
                            $result_enable = $this->db->insert($enable_key);
                            if($result_enable)
                            {
                                echo '<script>window.location="success.php#main"</script>';
                            }
                        }
					}
				}
				else
				{
					// echo '<script>alert("2")</script>';
				}
			}
		}

		public function cart_items()
		{
			$sId = session_id();
			$select_query = "SELECT SUM(quantity) as total FROM tbl_cart WHERE sId = '$sId'";
			$result_query = $this->db->select($select_query);
			return $result_query;
		}

		public function is_shipped($madat, $paid_type)
        {
            $check_query = "SELECT tbl_order.orderId, tbl_order.paid_type FROM tbl_order WHERE tbl_order.orderId = '$madat' AND tbl_order.paid_type = '$paid_type'";
			$result_check = $this->db->select($check_query);
			if($result_check == true)
			{
				//echo '1';
				$update_query = "UPDATE tbl_order SET status = '3' WHERE orderId = '$madat'";
				$result_update = $this->db->update($update_query);
			}

			else
			{
				$check_query = "SELECT tbl_cartonline.cart_online_Id, tbl_cartonline.paid_type FROM tbl_cartonline WHERE tbl_cartonline.cart_online_Id = '$madat' AND tbl_cartonline.paid_type = '$paid_type'";
				$result_check_dk2 = $this->db->select($check_query);
				if($result_check_dk2)
				{
					//echo '2';
					$update_query_dk2 = "UPDATE tbl_cartonline SET status = '3' WHERE cart_online_Id = '$madat'";
					$result_update_dk2 = $this->db->update($update_query_dk2);
				}
			}
        }

		public function is_cancel($madat_huy, $paid_type_huy)
		{
			$check_query = "SELECT tbl_order.orderId, tbl_order.paid_type FROM tbl_order WHERE tbl_order.orderId = '$madat_huy' AND tbl_order.paid_type = '$paid_type_huy'";
			$result_check = $this->db->select($check_query);
			if($result_check == true)
			{
				// echo '1';
				$update_query = "UPDATE tbl_order SET status = '4' WHERE orderId = '$madat_huy'";
				$result_update = $this->db->update($update_query);
			}

			else
			{
				$check_query = "SELECT tbl_cartonline.cart_online_Id, tbl_cartonline.paid_type FROM tbl_cartonline WHERE tbl_cartonline.cart_online_Id = '$madat_huy' AND tbl_cartonline.paid_type = '$paid_type_huy'";
				$result_check_dk2 = $this->db->select($check_query);
				if($result_check_dk2)
				{
					//echo '2';
					$update_query_dk2 = "UPDATE tbl_cartonline SET status = '4' WHERE cart_online_Id = '$madat_huy'";
					$result_update_dk2 = $this->db->update($update_query_dk2);
				}
			}
		}
	}	
?>




