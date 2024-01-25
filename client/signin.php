<?php
include "./connect/connect.php";

$err = [];
$loginError = ''; 
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($err)) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $checkEmail = mysqli_num_rows($query);

        if ($checkEmail == 1) {
            $checkPass = password_verify($password, $data['password']);
            
            if ($checkPass) {
                // Đúng -> lưu vào phiên
                $_SESSION['user'] = $data;
                header('location: home.php');
            } else {
                // Mật khẩu không đúng -> Gán thông báo lỗi
                $loginError = "Sai mật khẩu!";
            }
        } else {
            $loginError = "Email không tồn tại";
        }
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
            <header class="page-header"></header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Đăng nhập vào tài khoản của bạn</h3>
                        <p class="text-center text-muted">Nếu chưa có tài khoản, hãy nhấp vào <a href="signup.php">ĐĂNG KÝ</a> để cùng trải nghiệm dịch vụ tốt nhất đến từ chúng tôi.</p>
                        <hr>

                        <!-- Thêm thông báo lỗi -->
                        <?php if ($loginError): ?>
                            <div class="alert alert-danger">
                                <?php echo $loginError; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" role="form" id="signinForm">
                            <div class="top-margin">
                                <label>Email<span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['email'])) ? $err['email'] : '' ?></span></div>
                                <input type="email" name="email" class="form-control" >
                            </div>
                            <div class="top-margin">
                                <label>Mật khẩu <span class="text-danger">*</span></label>
                                <div class="has-error"><span><?php echo (isset($err['password'])) ? $err['password'] : '' ?></span></div>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-8">
                                    <b><a href="resetpass.php">Quên mật khẩu?</a></b>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </article>
        <!-- /Article -->

    </div>
</div> <!-- /container -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#signinForm form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'http://localhost/Web_QLKH/client/signin.php', 
            data: $(this).serialize(),
            success: function(response) {
                console.log(response); 
                
            }
        });
    });
});
</script>
<?php include "layouts/footer.php"; ?>
