<?php

include 'connect/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:orders.php');
}

if(isset($_POST['cancel'])){

   $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
   $update_orders->execute(['canceled', $get_id]);
   header('location:orders.php');

}

?>

<?php include 'layouts/header.php'; ?>
<header id="head" class="secondary"></header>

<section class="order-details">

   <h1 class="heading">Chi tiết </h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
      $select_orders->execute([$get_id]);
      if($select_orders->num_rows > 0){
         while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_product->execute([$fetch_order['product_id']]);
            if($select_product->num_rows > 0){
               while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                  $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                  $grand_total += $sub_total;
   ?>
   <div class="box">
      <div class="col">
         <p class="title"><i class="fas fa-calendar"></i><?= $fetch_order['date']; ?></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <p class="price"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
         <h3 class="name"><?= $fetch_product['name']; ?></h3>
         <p class="grand-total">Tổng tiền : <span><i class="fas fa-indian-rupee-sign"></i> <?= $grand_total; ?></span></p>
      </div>
      <div class="col">
         <p class="title">Địa chỉ thanh toán</p>
         <p class="user"><i class="fas fa-user"></i><?= $fetch_order['name']; ?></p>
         <p class="user"><i class="fas fa-phone"></i><?= $fetch_order['number']; ?></p>
         <p class="user"><i class="fas fa-envelope"></i><?= $fetch_order['email']; ?></p>
         <p class="user"><i class="fas fa-map-marker-alt"></i><?= $fetch_order['address']; ?></p>
         <p class="title">Trạng thái</p>
         <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo 'green';}elseif($fetch_order['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_order['status']; ?></p>
         <?php if($fetch_order['status'] == 'canceled'){ ?>
            <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Đặt lại</a>
         <?php }else{ ?>
         <form action="" method="POST">
            <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('cancel this order?');">
         </form>
         <?php } ?>
      </div>
   </div>
   <?php
            }
         }else{
            echo '<p class="empty">product not found!</p>';
         }
      }
   }else{
      echo '<p class="empty">no orders found!</p>';
   }
   ?>

   </div>

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>


<?php include 'connect/alert.php'; ?>

<?php include "layouts/footer.php"; ?>