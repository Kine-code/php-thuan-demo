<?php
include "./connect/connect.php";
$err = [];

// kiểm tra xem người dùng đã đăng nhập chưa
$user = isset($_SESSION['user']) ? $_SESSION['user'] : array();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // kiểm tra mật khẩu hiện tại với mật khẩu trong cơ sở dữ liệu
    if (password_verify($currentPassword, $user['password'])) {
        // mật khẩu hiện tại đúng, tiếp tục kiểm tra và cập nhật thông tin
        if (empty($name)) {
            $err['name'] = 'Bạn chưa đặt tên tài khoản';
        }
        if (empty($email)) {
            $err['email'] = 'Bạn chưa nhập email';
        }

        // kiểm tra liệu người dùng có muốn thay đổi mật khẩu hay không
        if (!empty($newPassword)) {
            if ($newPassword != $confirmPassword) {
                $err['confirm_password'] = 'Mật khẩu xác nhận không trùng khớp';
            }
        }

        // không có lỗi tiến hành cập nhật thông tin và mật khẩu
        if (empty($err)) {
            $name = mysqli_real_escape_string($conn, $name);
            $email = mysqli_real_escape_string($conn, $email);

            // cập nhật thông tin người dùng
            $updateUserSQL = "UPDATE users SET name = '$name', email = '$email' WHERE id = " . $user['id'];
            $updateUserQuery = mysqli_query($conn, $updateUserSQL);

            if ($updateUserQuery) {
                // nếu người dùng muốn thay đổi mật khẩu, thì cập nhật mật khẩu
                if (!empty($newPassword)) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePasswordSQL = "UPDATE users SET password = '$hashedNewPassword' WHERE id = " . $user['id'];
                    $updatePasswordQuery = mysqli_query($conn, $updatePasswordSQL);
                }

                // lấy lại thông tin người dùng sau khi cập nhật
                $getUserSQL = "SELECT * FROM users WHERE id = " . $user['id'];
                $getUserQuery = mysqli_query($conn, $getUserSQL);
                $updatedUserData = mysqli_fetch_assoc($getUserQuery);

                // Cập nhật phiên
                $_SESSION['user'] = $updatedUserData;
                header('location: home.php');
                exit();
            } else {
                $err['update_error'] = 'Có lỗi xảy ra khi cập nhật thông tin';
            }
        }
    } else {
        $err['current_password'] = 'Mật khẩu hiện tại không đúng';
    }
}
?>

<?php include "layouts/header.php"; ?>

<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">
    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Sửa thông tin và mật khẩu</h3>

                        <hr>

                        <form action="" method="Post" role="form">
                            <div class="top-margin">
                                <label>Tên tài khoản</label>
                                <div class="has-error"><span><?php echo (isset($err['name'])) ? $err['name'] : ''; ?></span></div>
                                <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>">
                            </div>
                            <div class="top-margin">
                                <label>Email<span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['email'])) ? $err['email'] : ''; ?></span></div>
                                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="top-margin">
                                <label>Mật khẩu hiện tại <span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['current_password'])) ? $err['current_password'] : ''; ?></span></div>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="top-margin">
                                <label>Mật khẩu mới<span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['new_password'])) ? $err['new_password'] : ''; ?></span></div>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="top-margin">
                                <label>Nhập lại mật khẩu mới<span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['confirm_password'])) ? $err['confirm_password'] : ''; ?></span></div>
                                <input type="password" name="confirm_password" class="form-control">
                            </div><br>
                            <div class="col-lg-8 text-right">
                                <button class="btn btn-action" type="submit">Sửa</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </article>
        <!-- /Article -->

    </div>
</div> <!-- /container -->


<?php include "layouts/footer.php"; ?>