<?php

include 'connect/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['add'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_files/'.$rename;

   if($image_size > 2000000){
      $warning_msg[] = 'Kích thước hình ảnh quá lớn!';
   }else{
      $add_product = $conn->prepare("INSERT INTO `products`(id, name, price, image) VALUES(?,?,?,?)");
      $add_product->execute([$id, $name, $price, $rename]);
      move_uploaded_file($image_tmp_name, $image_folder);
      $success_msg[] = 'Đã thêm sản phẩm!';
   }
   header("Location: view_products.php");
   exit();
}

?>

<?php include "layouts/header.php"; ?>
<header id="head" class="secondary"></header>
<section class="product-form">
<div class="col-lg-12 ">
      <img src="../assets/images/themkhohang.jpg" alt="">
   </div>
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Thêm kho hàng</h3>
      <p>Tên kho hàng<span>*</span></p>
      <input type="text" name="name" placeholder="" required maxlength="50" class="box">
      <p>Giá tiền <span>*</span></p>
      <input type="number" name="price" placeholder="" required min="0" max="9999999999" maxlength="10" class="box">
      <p>Ảnh kho hàng<span>*</span></p>
      <input type="file" name="image" required accept="image/*" class="box">
      <input type="submit" class="btn btn-primary btn-large" name="add" value="Thêm">
   </form>

</section>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'connect/alert.php'; ?>

<?php include "layouts/footer.php"; ?>