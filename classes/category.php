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
		
		public function insert_category($catName)
		{	
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			

			if(empty($catName)){
				$alert = "<span class='error'>Tên Danh Mục Sản Phẩm không được để trống</span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				$result = $this->db->insert($query);

				if($result){
					
					$alert = '<span class="success">Bạn đã thêm '  .$catName. '</span>' . '<span class="success"> vào Danh Mục Sản Phẩm Thành Công </span>';
					
					return $alert;
				}else{
					$alert = '<span class="error">Thêm '  .$catName. '</span>' . '<span class="error"> vào Danh Mục Sản Phẩm Thất Bại </span>';
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
					
					$alert = '<span class="success">Bạn đã sửa thành công loại sản phẩm '  .$catName. '</span>' . '<span class="success"> từ Danh Mục Loại Sản Phẩm</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã sửa thất bại loại sản phẩm '  .$catName. '</span>' . '<span class="error"> từ Danh Mục Loại Sản Phẩm</span>';
					return $alert;
				}
			}
		}

		public function del_cat($Id){
			$query = "DELETE FROM tbl_category WHERE catId = '$Id'";
			$result = $this->db->delete($query);
			if($result){
					
					$alert = '<span class="success">Bạn đã xoá Thành Công loại sản phẩm này</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã xóa Thất Bại loại sản phẩm này </span>';
					return $alert;
				}
			}

		public function show_category_fontend()
		{
			$query = "SELECT * FROM tbl_category order by catId desc";
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


