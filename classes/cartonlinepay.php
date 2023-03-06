<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
    require ($filepath."/../carbon/autoload.php");
    use Carbon\Carbon;
	use Carbon\CarbonInterval;
?>


<?php
	class cartonlinepay
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_cart_online_details($hoten, $sdt, $diachi, $customer_id)
        {
            $sId = session_id();
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $nowformat = $now->isoFormat('DD/MM/YYYY');
            $paid_type = "VNPAY";
            
            $disable_key = 
            "SET FOREIGN_KEY_CHECKS = 0";
            $result_disable = $this->db->insert($disable_key);
            
            if($result_disable)
            {
                // echo '<script>alert("1")</script>';
                $select_query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
                $get_product = $this->db->select($select_query);
                if($get_product)
                {
                    while($result = $get_product->fetch_assoc())
                    {
                        $cartId = $result['cartId'];
                        $productId = $result['productId'];
                        $productName = $result['productName'];
                        $price = $result['price'];
                        $quantity = $result['quantity'];
                        $total_price = $price * $quantity;
                        $image = $result['image'];
                        $code_cart = $result['code_cart_online'];
                        

                        $add_to_cart_access = "INSERT INTO tbl_cart_access(cartId,sId,productId,productName,quantity,price,image,code_cart_online,paid_type,paid_date_time,regisId) 
                        VALUES ('$cartId','$sId','$productId','$productName','$quantity','$total_price','$image','$code_cart','$paid_type','$now','$customer_id')";
                        $result_add_to_cart_access = $this->db->insert($add_to_cart_access);
                        
                        $insert_query = "INSERT INTO tbl_cartonline(productId, productName, price, quantity, image, code_cart_online, paid_date, hovaten, sdt, diachi, regisId, paid_type) 
                        VALUES ('$productId', '$productName', '$total_price', '$quantity', '$image', '$code_cart', '$nowformat', '$hoten', '$sdt', '$diachi', '$customer_id', '$paid_type')";

                        $resultinsert = $this->db->insert($insert_query);
                        
                        $query_update = "SELECT tbl_product.solg_from_storage FROM tbl_product WHERE productId = '$productId'"; 
                        $result_update = $this->db->update($query_update);
                        if($result_update)
                        {
                            while($row = $result_update->fetch_assoc())
                            {
                                $soluong_hientai = $row['solg_from_storage'];
                                $soluong_conlai = $soluong_hientai - $quantity;
                                $query_update_quantity = "UPDATE tbl_product SET solg_from_storage = '$soluong_conlai' WHERE productId = '$productId'";
                                $result_update_quantity = $this->db->update($query_update_quantity);
                            }

                        $query_del = "DELETE FROM tbl_cart WHERE sId = '$sId'";
                        $result = $this->db->delete($query_del);
                        if($result)
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
                }
            }
            else
            {
                echo '<script>alert("2")</script>';
            }

        }

        public function show_order_online()
        {
            $query = "SELECT * FROM tbl_cartonline";
            $result = $this->db->select($query);
            return $result;
        }

        public function confirm_cart($id){
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $nowformat = $now->isoFormat('DD/MM/YYYY');

			$query = "UPDATE tbl_cartonline SET
					status = '1', confirm_date = '$nowformat'
					WHERE cart_online_Id = '$id'";
			$result = $this->db->update($query);
			if($result){
					echo '<script>alert("Bạn đã xử lý thành công Đơn Hàng này!")</script>';
					echo '<script>window.location = "dathangonline.php"</script>';
			}else{
					$alert = '<div class="error"><center>Bạn đã xử lý Thất Bại Đơn Đặt Hàng này!</center></div>';
					return $alert;
				}
		}

		public function giaohang($id_giao){
			$query = "UPDATE tbl_cartonline SET
            status = '2'
            WHERE cart_online_Id = '$id_giao'";
			$result = $this->db->update($query);
			if($result){
                    echo '<script>alert("Xử lý thành công, đơn hàng này sẽ được vận chuyển!")</script>';
					echo '<script>window.location = "dathangonline.php"</script>';
			}else{
					$alert = '<div class="error"><center>Bạn đã xử lý Thất Bại Đơn Đặt Hàng này!</center></div>';
					return $alert;
				}
		}
		
	}
?>




