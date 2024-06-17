
<?php
$servename = "localhost";
$username = "root";
$password = "";
$database = "qlkh";

$conn = mysqli_connect($servename, $username, $password, $database);

mysqli_set_charset($conn, 'utf8');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem hàm create_unique_id() đã tồn tại chưa
if (!function_exists('create_unique_id')) {
    function create_unique_id()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

// if($conn->connect_error){
//     die("Kết nối không thành công".$conn->connect_error);
// }echo "kết nối thành công";
?>
