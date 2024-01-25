<?php
// Include file kết nối đến MySQL
include "./connect/connect.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');


// Kiểm tra nếu là yêu cầu POST và tồn tại token
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới
    if ($newPassword != $confirmPassword) {
        // Mật khẩu không khớp, xử lý thông báo lỗi hoặc chuyển hướng
        header("Location: resetpass.php?token=$token&error=password_mismatch");
        exit();
    }

    // Xử lý đặt lại mật khẩu trong cơ sở dữ liệu
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $token);
    $stmt->execute();

    // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
    if ($stmt->affected_rows > 0) {
        // Đặt lại thành công, có thể chuyển hướng hoặc hiển thị thông báo
        header("Location: login.php?reset_success=true");
        exit();
    } else {
        // Đặt lại không thành công, xử lý thông báo lỗi hoặc chuyển hướng
        header("Location: resetpass.php?token=$token&error=reset_failed");
        exit();
    }
}
?>

<?php include "layouts/header.php"; ?>
<header id="head" class="secondary"></header>
<!-- Form đặt lại mật khẩu -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Đặt lại mật khẩu</h3>
                    <p class="text-center text-muted">Nhập mật khẩu mới của bạn.</p>
                    <hr>

                    <!-- Form đặt lại mật khẩu -->
                    <form method="POST" action="resetpass.php">
                       
                        <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">

                        <div class="top-margin">
                            <label>Mật khẩu mới<span class="text-danger">*</span></label>
                            <input type="password" name="new_password" class="form-control">
                        </div>

                        <div class="top-margin">
                            <label>Xác nhận mật khẩu mới<span class="text-danger">*</span></label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-8 text-right">
                                <button class="btn btn-action" type="submit">Đặt lại mật khẩu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>