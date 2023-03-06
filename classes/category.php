<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
?>

<?php
	class category
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_category($data)
		{	
			// $catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $data['catName']);

			$check_cat = "SELECT * FROM tbl_category WHERE catName = '$catName' LIMIT 1";
			$result_check = $this->db->select($check_cat);

			if(empty($catName)){
				$alert = "<span class='error'>Tên Danh Mục Sản Phẩm không được để trống!</span>";
				return $alert;
			}

			elseif($result_check)
			{
				$alert = '<span class="error">Loại Sản Phẩm này đã được thêm vào. Vui lòng kiểm tra lại!</span';
				return $alert;
			}

			else 
			{
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				$result = $this->db->insert($query);
				if($result)
				{
					echo '<script>alert("Bạn đã thêm thành công vào danh mục sản phẩm! ")</script>';
					echo '<script>window.location = "addsp.php"</script>';
				}
				else
				{
					echo '<script>alert("Thêm thất bại vào danh mục sản phẩm! ")</script>';
					echo '<script>window.location = "addsp.php"</script>';
				}
			}
		}

		public function show_category()
		{
			$query = "SELECT * FROM tbl_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}


		public function getcatbyId($Id){
			$query = "SELECT * FROM tbl_category WHERE catId = '$Id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_category($catName,$Id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$Id = mysqli_real_escape_string($this->db->link, $Id);

			if(empty($catName)){
				$alert = "<span class='error'>Tên Danh Mục Sản Phẩm không được để trống</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$Id'";
				$result = $this->db->update($query);

				if($result){
					echo '<script>alert("Bạn đã sửa thành công loại sản phẩm ' . $catName .'! ")</script>';
					echo '<script>window.location = "listloaisp.php"</script>';
				}else{
					echo '<script>alert("Bạn đã sửa thất bại loại sản phẩm ' . $catName .'! ")</script>';
					echo '<script>window.location = "listloaisp.php"</script>';
				}
			}
		}

		public function del_cat($Id){
			$query = "DELETE FROM tbl_category WHERE catId = '$Id'";
			$result = $this->db->delete($query);
			if($result){
					
				echo '<script>alert("Bạn đã xoá thành công loại sản phẩm này! ")</script>';
				echo '<script>window.location = "listloaisp.php"</script>';
				}else{
					echo '<script>alert("Bạn đã xoá thất bại loại sản phẩm này! ")</script>';
				echo '<script>window.location = "listloaisp.php"</script>';
				}
			}

		public function show_category_fontend()
		{
			$query = "SELECT * FROM tbl_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_category_notselected($id)
		{
			$query = "SELECT * FROM tbl_category WHERE catId != $id";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_1category($id)
		{
			$query = "SELECT * FROM tbl_category WHERE catId = $id";
			$result = $this->db->select($query);
			return $result;
		}


		public function get_product_by_cat($id)
		{
			$query = "SELECT * FROM tbl_product WHERE catId = '$id' order by catId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}


		public function get_name_by_cat($id)
		{
			$query = "SELECT tbl_product.*, tbl_category.catName,tbl_category.catId FROM tbl_product, tbl_category 
			WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getallcat() {
			$query = "SELECT tbl_product.*, tbl_category.catName,tbl_category.catId FROM tbl_product, tbl_category 
			WHERE tbl_product.catId = tbl_category.catId ";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>

