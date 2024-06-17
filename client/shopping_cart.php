<?php

include 'connect/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30);
}


if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);

   $success_msg[] = 'Cập nhật thành công!';
}

if (isset($_POST['delete_item'])) {
   $cart_id = $_POST['cart_id'];
   $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

   $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
   $verify_delete_item->execute([$cart_id]);

   $result = $verify_delete_item->get_result(); // Lấy kết quả
   if ($result->num_rows > 0) {
      $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $delete_cart_id->execute([$cart_id]);
      $success_msg[] = 'Đã xóa đặt kho hàng!';
   } else {
      $warning_msg[] = 'Kho hàng trong giỏ hàng đã bị xóa!';
   }
}

if (isset($_POST['empty_cart'])) {
   $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $verify_empty_cart->execute([$user_id]);

   $result = $verify_empty_cart->get_result(); // Lấy kết quả
   if ($result->num_rows > 0) {
      $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart_id->execute([$user_id]);
      $success_msg[] = 'Giỏ hàng trống!';
   } else {
      $warning_msg[] = 'Giỏ hàng đã trống!';
   }
}

?>

<?php include 'layouts/header.php'; ?>
<header id="head" class="secondary"></header>

<section class="products">

   <h1 class="heading">Kho hàng bạn đã đặt</h1>

   <div class="box-container">

      <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      $result = $select_cart->get_result();

      if ($result->num_rows > 0) {
         while ($fetch_cart = $result->fetch_assoc()) {

            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_cart['product_id']]);
            $result_product = $select_products->get_result(); // Lấy kết quả

            if ($result_product->num_rows > 0) {
               $fetch_product = $result_product->fetch_assoc();
      ?>
               <form action="" method="POST" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
                  <h3 class="name"><?= $fetch_product['name']; ?></h3>
                  <div class="flex">
                     <p class="price"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch_cart['price']; ?></p>
                     <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
                     <button type="submit" name="update_cart" class="fa fa-pencil-square-o"> <b>Sửa</b>
                     </button>
                  </div>
                  <p class="sub-total">Giá tiền : <span><i class="fas fa-indian-rupee-sign"></i> <?= $sub_total = ($fetch_cart['qty'] * $fetch_cart['price']); ?></span></p>
                  <input type="submit" value="Xóa" name="delete_item" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa?');">
               </form>
      <?php
               $grand_total += $sub_total;
            } else {
               echo '<p class="empty">Sản phẩm không tồn tại!</p>';
            }
         }
      } else {
         echo '<p class="empty">Giỏ hàng của bạn đang trống!</p>';
      }
      ?>

   </div>

   <?php if ($grand_total != 0) { ?>
      <div class="cart-total">
         <p>Tổng giá tiền : <span><i class="fas fa-indian-rupee-sign"></i> <?= $grand_total; ?></span></p>
         <form action="" method="POST">
            <input type="submit" value="Xóa" name="empty_cart" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa?');">
         </form>
         <a href="checkout.php" class="btn btn-primary btn-large">Đặt ngay</a>
      </div>
   <?php } ?>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>
<?php include 'connect/alert.php'; ?>
<?php include "layouts/footer.php"; ?>