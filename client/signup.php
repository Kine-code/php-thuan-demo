<?php
include "./connect/connect.php";
$err = [];
if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$rPassword = $_POST['rPassword'];
	$choose = isset($_POST['choose']) ? (is_array($_POST['choose']) ? implode(', ', $_POST['choose']) : $_POST['choose']) : '';


	if (empty($name)) {
		$err['name'] = 'Bạn chưa đặt tên tài khoản';
	}
	if (empty($email)) {
		$err['email'] = 'Bạn chưa nhập email ';
	}
	if (empty($password)) {
		$err['password'] = 'Bạn chưa nhập password';
	}
	if ($password != $rPassword) {
		$err['rPassword'] = 'Mật khẩu sai!';
	}
	if (empty($choose)) {
		$err['choose'] = 'Bạn chưa chọn điều khoản của chúng tôi!';
	}

	if (empty($err)) {
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users(name, email, password,choose) VALUES ('$name','$email','$pass','$choose')";
		$query = mysqli_query($conn, $sql);
		// Kiểm tra xem người dùng đã xác thực chưa, chuyển hướng đến trang đăng nhập nếu chưa
		if ($query) {
			// Thiết lập phiên và sau đó chuyển hướng đến trang chủ

			$_SESSION['user'] = array(
				'name' => $name,
				'email' => $email,
				// Các trường thông tin khác có thể được thêm vào tùy theo cần thiết
			);
			header('location: home.php');
			exit(); // Đảm bảo thoát sau khi chuyển hướng
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
			<header class="page-header">
			</header>

			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3 class="thin text-center">Tạo một tài khoản mới</h3>
						<p class="text-center text-muted">Nếu bạn đã có tài khoản, <a href="signup.php">ĐĂNG NHẬP</a> để truy cập những tiện ích sẵn có của chúng tôi. </p>
						<hr>

						<form action="" method="Post" role="form" id="signinForm">
							<div class="top-margin">
								<label>Tên tài khoản</label>
								<div class="has-error"><span><?php echo (isset($err['name'])) ? $err['name'] : '' ?></span></div>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="top-margin">
								<label>Email<span class="text-danger">*</span></label>
								<div class="has-error"><span><?php echo (isset($err['email'])) ? $err['email'] : '' ?></span></div>
								<input type="email" name="email" class="form-control">
							</div>

							<div class="row top-margin">
								<div class="col-sm-6">
									<label>Mật khẩu <span class="text-danger">*</span></label>
									<div class="has-error"><span><?php echo (isset($err['password'])) ? $err['password'] : '' ?></span></div>
									<input type="password" name="password" class="form-control">
								</div>
								<div class="col-sm-6">
									<label>Xác nhận mật khẩu <span class="text-danger">*</span></label>
									<div class="has-error"><span> <?php echo (isset($err['rPassword'])) ? $err['rPassword'] : '' ?> </span></div>
									<input type="password" name="rPassword" class="form-control">

								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-lg-8">
									<label class="checkbox">
										<div class="has-error"><span><?php echo (isset($err['choose'])) ? $err['choose'] : '' ?></span></div>
										<input type="checkbox" name="choose">
										Tôi đã đọc và đồng ý với các <a href="dieukhoan.php">Điều khoản</a>
									</label>
								</div>
								<div class="col-lg-4 text-right">
									<button class="btn btn-action" type="submit">Đăng ký</button>
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

<script>
$(document).ready(function() {
    $('#signupForm form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'http://localhost/Web_QLKH/client/signup.php', // ten tep
            data: $(this).serialize(),
            success: function(response) {
                console.log(response); // Ghi lại phản hồi từ máy chủ
               
            }
        });
    });
});
</script>


<?php include "layouts/footer.php"; ?>