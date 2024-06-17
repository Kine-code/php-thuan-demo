<footer id="footer" class="top-space">
	<div class="footer1">
		<div class="container">
			<div class="row">
				<div class="col-md-5 panel">
					<h3 class="panel-title">About Lock3p</h3>
					<div class="panel-body">
						<p>Lock3p là không gian của bạn, nơi mà tài sản cá nhân của bạn được tôn trọng và giữ gìn. Hãy đến và cảm nhận sự khác biệt của chúng tôi. Đặt dịch vụ ngay hôm nay và trở thành một phần của cộng đồng Lock3p, nơi mà chúng tôi không chỉ là đối tác, mà còn là bạn bè đồng hành trong hành trình lưu trữ và chia sẻ cuộc sống.</p>
					</div>
				</div>

				<div class="col-md-4 panel contact">
					<h3 class="panel-title">Liên hệ</h4>
						<div class="panel-body">
							<p>Lock3p - Không gian tận hưởng cá nhân của bạn</p>
							<ul>
								<li><i class="fa fa-phone"></i> 0376679803</li>
								<li><a href="#"><i class="fa fa-envelope-o"></i> lock3p@gmail.com</a></li>
							</ul>
						</div>
				</div>

				<div class="col-md-3 panel">
					<h3 class="panel-title">Theo dõi</h3>
					<div class="panel-body">
						<p class="follow-me-icons">
							<a href=""><i class="fa fa-twitter fa-2"></i></a>
							<a href=""><i class="fa fa-dribbble fa-2"></i></a>
							<a href="https://github.com/Kine-code/php-thuan-demo"><i class="fa fa-github fa-2"></i></a>
							<a href="https://www.facebook.com/"><i class="fa fa-facebook fa-2"></i></a>
							<a href="https://www.youtube.com/channel/UCp8frkSn58CaooT_lkOOnAA"><i class="fa fa-youtube fa-2"></i></a>
							<a href=""><i class="fa fa-pinterest fa-2"></i></a>
						</p>
					</div>
				</div>

			</div> <!-- /row of panels -->
		</div>
	</div>

	<div class="footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-6 panel">
					<div class="panel-body">
						<p class="simplenav">
							<a href="home.php">Trang chủ</a> |
							<a href="about.php">Về chúng tôi</a> |
							<a href="view_products.php">Thuê kho hàng</a> |
							<a href="contact.php">Liên hệ</a>
						</p>
					</div>
				</div>
			</div> <!-- /row of panels -->
		</div>
	</div>

</footer>





<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="../assets/js/modernizr-latest.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.cslider.js"></script>
<script src="../assets/js/headroom.min.js"></script>
<script src="../assets/js/jQuery.headroom.min.js"></script>
<script src="../assets/js/custom.js"></script>
</body>

</html>
<script>
	$(document).ready(function() {
		// Ẩn nút Đăng xuất ban đầu
		$("#logoutBtn").hide();

		// Sự kiện khi click vào tên người dùng
		$("#userNameBtn").click(function() {
			// Hiển thị nút Đăng xuất, ẩn nút Đăng nhập / Đăng ký
			$("#logoutBtn").show();
			$("#loginBtn").hide();
		});
	});
</script>