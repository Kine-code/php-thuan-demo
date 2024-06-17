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
				<li><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0280585710457!2d105.92313797504407!3d21.031563280618496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a9a72986b885%3A0x928dd277889a0293!2zSOG7hyB0aOG7kW5nIGtobyB4xrDhu59uZyBDdHkgVE5EIGNobyB0aHXDqg!5e0!3m2!1svi!2s!4v1706192567883!5m2!1svi!2s" width="400" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></li>
			</ul>
		</div>

	</aside>
	<!-- /Sidebar -->

</div>
</div> <!-- /container -->
<br>





<?php include "layouts/footer.php"; ?>