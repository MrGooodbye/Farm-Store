<?php require('../carbon/autoload.php') ?>
<?php require_once('storage.php')?>
<?php require_once('product.php')?>
<?php require_once('cart.php')?>
<?php require_once('thongke.php')?>

<?php $storage = new storage(); ?>
<?php $product = new product(); ?>
<?php $cart = new cart(); ?>
<?php $thongke = new thongke(); ?>
<?php 
  use Carbon\Carbon;
	use Carbon\CarbonInterval;
?>

<?php 
  if(isset($_POST['nameProduct']))
  {
    $nameProduct = $_POST['nameProduct'];
    $storage->show_storage_quatity($nameProduct);
  }  
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
?>

<?php 
  if(isset($_POST['today']))
  {
    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $nowformat = $now->isoFormat('DD/MM/YYYY');
    $thongke->thongke_sanphamban_homnay($nowformat);
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

