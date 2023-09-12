<?php require('../carbon/autoload.php') ?>
<?php require_once('storage.php')?>
<?php require_once('product.php')?>
<?php require_once('cart.php')?>
<?php require_once('cartonlinepay.php')?>
<?php require_once('thongke.php')?>
<?php require_once('customer.php')?>

<?php $storage = new storage(); ?>
<?php $product = new product(); ?>
<?php $cart = new cart(); ?>
<?php $ctonl = new cartonlinepay();?>
<?php $thongke = new thongke(); ?>
<?php $customer = new customer(); ?>
<?php $thongke = new thongke(); ?>

<?php 
  use Carbon\Carbon;
	use Carbon\CarbonInterval;
  $now = Carbon::now('Asia/Ho_Chi_Minh');
  $nowformat = $now->isoFormat('DD/MM/YYYY');
?>

<?php 
  if(isset($_POST['nameProduct']))
  {
    $nameProduct = $_POST['nameProduct'];
    $storage->show_storage_quatity($nameProduct);
  } 
  elseif(isset($_POST['indanhsach_nhapkho']))
  {
    $storage->in_file_excel_nhapkho();
  }
  elseif(isset($_POST['indanhsach_nhapkho_homnay']))
  {
    $storage->in_file_excel_nhapkho_homnay($nowformat);
  }
  // elseif(isset($_POST['suggest_export_sp']))
  // {
  //   $suggest_export_sp = $_POST['suggest_export_sp'];
  //   $storage->search_recommend($suggest_export_sp);
  // }
?>

<?php 
  if(isset($_GET['checkpd']))
  {
    $check_pd = $_GET['checkpd'];
    $product->checkquantity($check_pd);
  }

  elseif(isset($_POST['Product_Id']))
  {
    $Product_Id = $_POST['Product_Id'];
    $product->check_plus_quantity($Product_Id);
  }

  elseif(isset($_POST['id_product']))
  {
    $Id_Product = $_POST['id_product'];
    $product->check_change_quantity($Id_Product);
  }
  elseif(isset($_POST['infile_excel']))
  {
    $product->in_file_excel_xuatkho();
  }
  elseif(isset($_POST['in_xuatkho_homnay']))
  {
    $product->in_file_excel_xuatkho_homnay($nowformat);
  }
  elseif(isset($_POST['show_datatable_product']))
  {
    $product->refresh_product_table();
  }
  elseif(isset($_POST['auto_delete']))
  {
    $product->auto_delete_sale();
  }
?>

<?php 
  if(isset($_POST['today']))
  {
    $thongke->thongke_sanphamban_homnay($nowformat);
  }

  elseif(isset($_POST['thoigian_thongke_doanhthu']))
  {
    $thoi_gian = $_POST['thoigian_thongke_doanhthu'];
    $thongke->thongke_doanhthu_theo_thoigian($thoi_gian);
  }

  elseif(isset($_POST['thoigian_thongke_sanpham']))
  {
    $thoi_gian = $_POST['thoigian_thongke_sanpham'];
    $thongke->thongke_sanpham_theo_thoigian($thoi_gian);
  }
?>


<?php 
  if(isset($_POST['Id_Cart']) && $_POST['Sl_Conlai'])
  {
    $Id_Cart = $_POST['Id_Cart'];
    $Sl_conlai = $_POST['Sl_Conlai'];
    $cart->update_minus_quantity($Id_Cart, $Sl_conlai);
  }

  elseif(isset($_POST['Cart_Id']) && $_POST['Sl_Tang'])
  {
    $Cart_Id = $_POST['Cart_Id'];
    $Sl_Tang = $_POST['Sl_Tang'];
    $cart->update_add_quantity($Cart_Id, $Sl_Tang);
  }

  elseif(isset($_POST['GioHang_Id']) && $_POST['SoLuongMoi'])
  {
    $GioHang_Id = $_POST['GioHang_Id'];
    $SoLuong_Moi = $_POST['SoLuongMoi'];
    $cart->update_change_quantity($GioHang_Id, $SoLuong_Moi);
  }
?>

<?php 
  if(isset($_POST['id_doi_pass']))
  {
    $id_acc_changepass = $_POST['id_doi_pass'];
    $customer->verify_otp_mobile($id_acc_changepass);
  }
?>

