<?php
/**
*Session Class
**/
class Session{
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }//tạo session ban đầu vd khi thêm vào giỏ hàng, thanh toán, đăng nhập thì session này sẽ đảm nhận chức năng đó điều này được gọi là lưu các phiên giao dịch, khi page dc f5 thì dữ liệu vẫn còn được lưu

 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }

 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }

 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) 
    {
     unset($_SESSION['adminlogin']);
     header("Location:login.php"); 
    }
 }

 public static function checkLogin(){
    self::init();
    if (self::get("adminlogin")== true) {
     header("Location:index.php");
    }
 }

 public static function unset(){
   unset($_SESSION['adminlogin']);
  header("Location:login.php");
 }
}
?>

