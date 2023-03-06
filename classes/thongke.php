<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	require ($filepath."/../carbon/autoload.php");
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
?>

<?php 
class thongke
{
    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function luu_thongke_online($id_cartonline)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $nowformat = $now->isoFormat('DD/MM/YYYY');

        $select_date = "SELECT * FROM tbl_thongke_doanhthu WHERE ngay_ban = '$nowformat'";
        $result_select_date = $this->db->select($select_date);
        if($result_select_date == true)
        {
            // echo "có ngày này";
            while($row_thongke = mysqli_fetch_assoc($result_select_date))
            {
                $tong_sodonhang = $row_thongke['tong_sodonhang'];
                $tong_soluongban = $row_thongke['tong_soluongban'];
                $tong_doanhthu = $row_thongke['tong_doanhthu'];

                $select_query = "SELECT * FROM tbl_cartonline WHERE cart_online_Id = '$id_cartonline'";
                $result_select = $this->db->select($select_query);

                if($result_select)
                {
                    while($row = mysqli_fetch_assoc($result_select))
                    {
                        $productId = $row['productId'];
                        $productName = $row['productName'];

                        $tong_soluong_ban = $row['quantity'];
                        $tong_gia_ban = $row['price'];

                        $tong_sodon_update = $tong_sodonhang + 1;
                        $tong_soluong_update = $tong_soluongban + $tong_soluong_ban;
                        $tong_doanhthu_update = $tong_doanhthu + $tong_gia_ban;

                        $query_update = "UPDATE tbl_thongke_doanhthu SET tong_sodonhang = ' $tong_sodon_update', tong_soluongban = '$tong_soluong_update', tong_doanhthu = '$tong_doanhthu_update' WHERE ngay_ban = '$nowformat'";
                        $result_update = $this->db->update($query_update);
                    }

                    //kết thúc thống kê doanh thu

                    $query_select_thongke_sanpham = "SELECT tbl_thongke_sanpham.price, tbl_thongke_sanpham.quantity FROM tbl_thongke_sanpham WHERE productId = '$productId'";
                    $result_select_thongke_sanpham = $this->db->select($query_select_thongke_sanpham);

                    if($result_select_thongke_sanpham)
                    {
                        while($row_thongke_sanpham = mysqli_fetch_assoc($result_select_thongke_sanpham))
                        {
                            $tonggia_thongke_hientai = $row_thongke_sanpham['price'];
                            $tongsoluong_thongke_hientai = $row_thongke_sanpham['quantity'];
                        }
                                
                        $tonggia_thongke_moi = $tonggia_thongke_hientai + $tong_gia_ban;
                        $tongsoluong_thongke_moi = $tongsoluong_thongke_hientai + $tong_soluong_ban;

                        $query_update_sanpham_thongke = "UPDATE tbl_thongke_sanpham SET price = '$tonggia_thongke_moi', quantity = '$tongsoluong_thongke_moi' WHERE productId = '$productId'";
                        $result_query_update_sanpham_thongke = $this->db->update($query_update_sanpham_thongke);
                    }

                    else
                    {
                        $query_insert_thongke_sanpham = "INSERT INTO tbl_thongke_sanpham(ngay_ban, productId, productName, price, quantity) VALUES ('$nowformat', '$productId', '$productName', '$tong_gia_ban', '$tong_soluong_ban')";
                        $result_query_insert_thongke_sanpham = $this->db->insert($query_insert_thongke_sanpham);
                    }
                }
                else{}
            }
        }
        else
        {
            // echo "không có ngày này";
            $select_query = "SELECT * FROM tbl_cartonline WHERE cart_online_Id = '$id_cartonline'";
            $result_select = $this->db->select($select_query);
            $tongso_donhang = 1;
            if($result_select)
            {
                while($row = mysqli_fetch_assoc($result_select))
                {
                    $productId = $row['productId'];
                    $productName = $row['productName'];

                    $tong_soluong_ban = $row['quantity'];
                    $tong_gia_ban = $row['price'];

                    $insert_thongke_doanhthu_homnay = "INSERT INTO tbl_thongke_doanhthu(ngay_ban, tong_sodonhang, tong_soluongban, tong_doanhthu) VALUES ('$nowformat', '$tongso_donhang', '$tong_soluong_ban', '$tong_gia_ban')";
                    $result_insert = $this->db->insert($insert_thongke_doanhthu_homnay);

                    $insert_thongke_sanpham_homnay  = "INSERT INTO tbl_thongke_sanpham(ngay_ban, productId, productName, price, quantity) VALUES ('$nowformat', '$productId', '$productName', '$tong_gia_ban', '$tong_soluong_ban')";
                    $result_insert_thongke_sanpham = $this->db->insert($insert_thongke_sanpham_homnay);
                }
            }
            else{}
        }
    }

    public function luu_thongke_offline($id_cartoffline)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $nowformat = $now->isoFormat('DD/MM/YYYY');

        $select_date = "SELECT * FROM tbl_thongke_doanhthu WHERE ngay_ban = '$nowformat'";
        $result_select_date = $this->db->select($select_date);

        //hàm select() trả về kiểu boolean nên phải dùng true, false để so sánh

        if($result_select_date == true)
        {
            // echo "có ngày này";
            while($row_thongke = mysqli_fetch_assoc($result_select_date))
            {
                $tong_sodonhang = $row_thongke['tong_sodonhang'];
                $tong_soluongban = $row_thongke['tong_soluongban'];
                $tong_doanhthu = $row_thongke['tong_doanhthu'];
            }

            $select_query = "SELECT * FROM tbl_order WHERE orderId = '$id_cartoffline'";
            $result_select = $this->db->select($select_query);

            if($result_select)
            {
                while($row = mysqli_fetch_assoc($result_select))
                {
                    $productId = $row['productId'];
                    $productName = $row['productName'];

                    $tong_soluong_ban = $row['quantity'];
                    $tong_gia_ban = $row['price'];
                }

                $tong_sodon_update = $tong_sodonhang + 1;
                $tong_soluong_update = $tong_soluongban + $tong_soluong_ban;
                $tong_doanhthu_update = $tong_doanhthu + $tong_gia_ban;
                    
                $query_update = "UPDATE tbl_thongke_doanhthu SET tong_sodonhang = '$tong_sodon_update', tong_soluongban = '$tong_soluong_update', tong_doanhthu = '$tong_doanhthu_update' WHERE ngay_ban = '$nowformat'";
                $result_update = $this->db->update($query_update);

                //kết thúc thống kê doanh thu

                $query_select_thongke_sanpham = "SELECT tbl_thongke_sanpham.price, tbl_thongke_sanpham.quantity FROM tbl_thongke_sanpham WHERE productId = '$productId' AND ngay_ban = '$nowformat'";
                $result_select_thongke_sanpham = $this->db->select($query_select_thongke_sanpham);

                if($result_select_thongke_sanpham)
                {
                    while($row_thongke_sanpham = mysqli_fetch_assoc($result_select_thongke_sanpham))
                    {
                        $tonggia_thongke_hientai = $row_thongke_sanpham['price'];
                        $tongsoluong_thongke_hientai = $row_thongke_sanpham['quantity'];
                    }
                            
                    $tonggia_thongke_moi = $tonggia_thongke_hientai + $tong_gia_ban;
                    $tongsoluong_thongke_moi = $tongsoluong_thongke_hientai + $tong_soluong_ban;

                    $query_update_sanpham_thongke = "UPDATE tbl_thongke_sanpham SET price = '$tonggia_thongke_moi', quantity = '$tongsoluong_thongke_moi' WHERE productId = '$productId'";
                    $result_query_update_sanpham_thongke = $this->db->update($query_update_sanpham_thongke);
                }

                else
                {
                    $query_insert_thongke_sanpham = "INSERT INTO tbl_thongke_sanpham(ngay_ban, productId, productName, price, quantity) VALUES ('$nowformat', '$productId', '$productName', '$tong_gia_ban', '$tong_soluong_ban')";
                    $result_query_insert_thongke_sanpham = $this->db->insert($query_insert_thongke_sanpham);
                }
            }

            else{}
        }

        else
        {
            // echo "khong có ngày này";
            $select_query = "SELECT * FROM tbl_order WHERE orderId = '$id_cartoffline'";
            $result_select = $this->db->select($select_query);
            $tongso_donhang = 1;
            if($result_select)
            {
                while($row = mysqli_fetch_assoc($result_select))
                {
                    $productId = $row['productId'];
                    $productName = $row['productName'];

                    $tong_soluong_ban = $row['quantity'];
                    $tong_gia_ban = $row['price'];

                    $insert_thongke_doanhthu_homnay = "INSERT INTO tbl_thongke_doanhthu(ngay_ban, tong_sodonhang, tong_soluongban, tong_doanhthu) VALUES ('$nowformat', '$tongso_donhang', '$tong_soluong_ban', '$tong_gia_ban')";
                    $result_insert_doanhthu = $this->db->insert($insert_thongke_doanhthu_homnay);

                    $insert_thongke_sanpham_homnay  = "INSERT INTO tbl_thongke_sanpham(ngay_ban, productId, productName, price, quantity) VALUES ('$nowformat', '$productId', '$productName', '$tong_gia_ban', '$tong_soluong_ban')";
                    $result_insert_thongke_sanpham = $this->db->insert($insert_thongke_sanpham_homnay);
                }
            }
            else{}
        }
    }  
    
    public function get_thongke_homnay($nowformat)
    {
        $query_select = "SELECT * FROM tbl_thongke_doanhthu WHERE ngay_ban = '$nowformat'";
        $result_select = $this->db->select($query_select);
        return $result_select;
    }

    public function get_thongke_sanpham_homnay($nowformat)
    {
        $query_select = "SELECT tbl_thongke_sanpham.productName, tbl_thongke_sanpham.quantity FROM tbl_thongke_sanpham WHERE ngay_ban = '$nowformat' ORDER BY quantity DESC LIMIT 1";
        $result_select = $this->db->select($query_select);
        return $result_select;
    }

    public function thongke_sanphamban_homnay($nowformat)
    {
        $query_select = "SELECT tbl_thongke_sanpham.ngay_ban, tbl_thongke_sanpham.productName, tbl_thongke_sanpham.price, tbl_thongke_sanpham.quantity FROM tbl_thongke_sanpham WHERE tbl_thongke_sanpham.ngay_ban = '$nowformat'";
        $result_select = $this->db->select($query_select);
        if($result_select)
        {
            // $result_array = array();
            while($result = mysqli_fetch_array($result_select))
            {
                $result_array[] = $result;
    
                foreach($result_array as $result)
                {
                    $Date = $result['ngay_ban'];
                    $TenSanPham = $result['productName'];
                    $GiaSanPham = $result['price'];
                    $SoluongSanPham = $result['quantity'];
                }	

                $data[] = array('ngay_ban' => $Date, 'ten_sp' => $TenSanPham, 'gia_sp' => $GiaSanPham, 'soluong_sp' => $SoluongSanPham);
            }
            echo json_encode($data);
        }
    }

    public function get_confirm_today($getdon_homnay)
    {
        $select_query = "SELECT tbl_order.hotenkhach, tbl_order.sdt, tbl_order.diachi, tbl_order.productId, tbl_order.productName, tbl_order.quantity, tbl_order.price, tbl_order.image, tbl_order.paid_date, tbl_order.paid_type, tbl_order.status, tbl_order.confirm_date 
        FROM tbl_order WHERE tbl_order.confirm_date = '$getdon_homnay'
        UNION
        SELECT tbl_cartonline.hovaten, tbl_cartonline.sdt, tbl_cartonline.diachi, tbl_cartonline.productId, tbl_cartonline.productName, tbl_cartonline.quantity, tbl_cartonline.price, tbl_cartonline.image, tbl_cartonline.paid_date, tbl_cartonline.paid_type, tbl_cartonline.status, tbl_cartonline.confirm_date 
        FROM tbl_cartonline 
        WHERE tbl_cartonline.confirm_date = '$getdon_homnay'";
        $result_select = $this->db->select($select_query);
        return $result_select;
    }
}

?>