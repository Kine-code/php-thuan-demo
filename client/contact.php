<?php
include "connect/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = htmlspecialchars($_POST["full_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    $message = htmlspecialchars($_POST["message"]);

    // Thực hiện truy vấn SQL để chèn dữ liệu vào bảng contacts
    $insert_contact = $conn->prepare("INSERT INTO contacts (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)");
    $insert_contact->bind_param("ssss", $full_name, $email, $phone_number, $message);
    $insert_contact->execute();

    // Hiển thị thông báo hoặc thực hiện các hành động khác sau khi lưu dữ liệu
    if ($insert_contact) {
        // echo "Gửi tin nhắn thành công!";
    } else {
        // echo "Đã xảy ra lỗi khi gửi tin nhắn.";
    }
    $insert_contact->close();
}
?>

<?php include "layouts/header.php"; ?>

<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">


	<div class="row">

		<!-- Article main content -->
		<article class="col-sm-9 maincontent">
			<header class="page-header">
				<h1 class="page-title">Liên hệ</h1>
			</header>

			<p>
				Chúng tôi luôn sẵn sàng lắng nghe bạn, vui lòng điền các thông tin cần thiết ở phía dưới.
			</p>
			<br>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="row">
					<div class="col-sm-12">
						<input class="form-control" type="text" name="full_name" placeholder="Họ và tên" value="<?= isset($user['name']) ? $user['name'] : ''; ?>" required> <br>
					</div>
					<div class="col-sm-12">
						<input class="form-control" type="text" name="email" placeholder="Email" value="<?= isset($user['email']) ? $user['email'] : ''; ?>" required><br>
					</div>
					<div class="col-sm-12">
						<input class="form-control" type="text" name="phone_number" placeholder="Số điện thoại" value="<?= isset($user['phone_number']) ? $user['phone_number'] : ''; ?>" required><br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<textarea name="message" placeholder="Nhập tin nhắn của bạn..." class="form-control" rows="9"></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<input class="btn btn-action pull-left" type="submit" value="Gửi tin nhắn">
					</div>
					<div class="col-sm-6 text-right">
					</div>
	</div>
	</form>

	</article>
	<!-- /Article -->

	<!-- Sidebar -->
	<aside class="col-sm-3 sidebar sidebar-right">

		<div class="panel contact">
			<h4>Địa chỉ</h4>
			<ul>
				<li><i class="fa fa-phone"></i> 1-123-345-6789</li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> lock3p@locker.com</a></li>
				<li><i class="fa fa-flag"></i> 102 Bát Khối, Quận Long Biên, Tp Hà Nội</i></li>
			</ul>
		</div>

	</aside>
	<!-- /Sidebar -->

</div>
</div> <!-- /container -->




<?php include "layouts/footer.php"; ?>