<?php
include "./connect/connect.php";
unset($_SESSION['user']); // Xóa tất cả các biến phiên

// Chuyển hướng về trang đăng nhập hoặc trang chính của bạn
header('location: home.php');
exit();
?>
