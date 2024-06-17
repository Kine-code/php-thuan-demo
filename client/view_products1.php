<?php
include 'connect/connect.php';
$total_cart_items = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : getCartItemCount();
if (!isset($_SESSION['cart_count'])) {
	$_SESSION['cart_count'] = getCartItemCount();
 }
 
 $total_cart_items = $_SESSION['cart_count'];
 function getCartItemCount() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}
if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = create_unique_id();
   setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 30);
}

$count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$count_cart_items->bind_param("s", $user_id);
$count_cart_items->execute();
$count_cart_items->store_result();
$total_cart_items = $count_cart_items->num_rows;

if (isset($_POST['add_to_cart'])) {
   // Kiểm tra xem người dùng đã đăng nhập chưa
   if (!isset($_SESSION['user'])) {
      // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
      header("Location: signin.php");
      exit();
   }

   $id = create_unique_id();
   $product_id = $_POST['product_id'];
   $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   try {
      // Thực hiện truy vấn để lấy thông tin sản phẩm
      $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
      $select_price->bind_param("s", $product_id);
      $select_price->execute();
      $result = $select_price->get_result();

      if ($result->num_rows > 0) {
         $fetch_prodcut = $result->fetch_assoc();

         // Thêm sản phẩm vào giỏ hàng
         $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
         $insert_cart->bind_param("sssss", $id, $user_id, $product_id, $fetch_prodcut['price'], $qty);
         $insert_cart->execute();

         $success_msg[] = 'Đã thêm vào giỏ hàng!';
      } else {
         $warning_msg[] = 'Sản phẩm không có!';
      }
   } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
   }
   header("Location: view_products1.php");
   exit();
}
?>


<?php include 'layouts/header.php'; ?>
<header id="head" class="secondary"></header>


<section class="products">

   <h1 class="heading">Các kho xưởng</h1>

   <div class="box-container">

      <?php
      try {
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $result = $select_products->get_result(); // Get the result set

         while ($fetch_prodcut = $result->fetch_assoc()) {
      ?>
            <form action="" method="POST" class="box" enctype="multipart/form-data">
               <img src="uploaded_files/<?= $fetch_prodcut['image']; ?>" class="image" alt="">
               <div class="panel-body text-center">
						<i class="fa fa-star" style="color:gold"></i>
							<i class="fa fa-star" style="color:gold"></i>
							<i class="fa fa-star" style="color:gold"></i>
							<i class="fa fa-star" style="color:gold"></i>
							<i class="fa fa-star" style="color:gold"></i>
					</div>
               <h3 class="name"><?= $fetch_prodcut['name'] ?></h3>
               <input type="hidden" name="product_id" value="<?= $fetch_prodcut['id']; ?>">
               <div class="flex">
                  <p class="price"><i class="fas fa-indian-rupee-sign"></i><?= $fetch_prodcut['price'] ?></p>
                  <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
               </div>
               <input type="submit" name="add_to_cart" class="btn btn-primary btn-large" value="Thêm vào giỏ" >
               <a href="contact.php?get_id=<?= $fetch_prodcut['id']; ?>" class="delete-btn">Đặt ngay</a>
            </form>
      <?php
         }
      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
      }
      ?>

   </div>
   <div class="col-lg-12 pagination text-center">
        <!-- <span class="p-3">1</span> -->
        <a href="#">&laquo;</a>
        <a href="view_products.php">1</a>
        <a class="active" href="view_products.php">2</a>
        <a href="view_products.php">3</a>
        <a href="view_products.php">4</a>
        <a href="view_products.php">5</a>
        <a href="view_products.php">6</a>
        <a href="view_products.php">&raquo;</a>
      </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'connect/alert.php'; ?>

<?php include "layouts/footer.php"; ?>