<?php

include "./connect/connect.php";
$user = isset($_SESSION['user']) ? $_SESSION['user'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>LOCK3P</title>
	<link rel="icon" href="../assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" type="text/css" href="../assets/css/da-slider.css" />
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<style>
		.has-error {
			color: red;
		}

		.pagination {}

		.pagination a {
			color: black;
			padding: 8px 16px;
			text-decoration: none;
			transition: background-color .3s;
		}

		/* Style the active/current link */
		.pagination a.active {
			background-color: silver;
			color: white;
		}

		/* Add a grey background color on mouse-over */
		.pagination a:hover:not(.active) {
			background-color: #ddd;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		tr:hover {
			background-color: silver;
		}
	</style>
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="home.php"><img src="../assets/images/logo.png" alt="Atlanta HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="home.php">Trang chủ</a></li>
					<li><a href="about.php">Giới thiệu</a></li>
					<li><a href="view_products.php">Thuê kho hàng </a></li>
					<!-- <li><a href="view_products.php" class="dropdown-toggle" data-toggle="dropdown">Thuê kho hàng</a>
						<ul class="dropdown-menu">
							<li><a href="view_products.php">Giá Kho </a></li>
							<li><a href="add_product.php"> Thêm kho</a></li>
						</ul>
					</li> -->
					<li><a href="contact.php">Liên hệ</a></li>

					<li><a href="shopping_cart.php"><i class="fa fa-shopping-cart"></i> </a></li>
					<!-- <span><= isset($total_cart_items) ? $total_cart_items : 1; ?></span> -->

					<?php if (isset($user['name'])) { ?>
						<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user['name']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="editprofile.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa thông tin</a></li>
								<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></li>
								<li><a href="add_product.php">demo</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="signup.php"> Đăng ký</a></li>
								<li><a href="signin.php"> Đăng nhập</a></li>
							</ul>

						<?php } ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->