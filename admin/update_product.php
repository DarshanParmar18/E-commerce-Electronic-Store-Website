<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_POST['update'])) {

  $pid = $_POST['pid'];
  $name = strip_tags($_POST['name']);
  $price = strip_tags($_POST['price']);
  $details = strip_tags($_POST['details']);

  $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ? WHERE id = ?");
  $update_product->execute([$name, $price, $details, $pid]);

  $success_msg[] = 'Product updated successfully!';
  header('location:Admin_products.php');

  $old_image = $_POST['old_image'];
  $new_image = $_FILES['image']['name'];

  if (!empty($new_image)) {
    $new_image = strip_tags($new_image);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../img/store';
    $image_path = $image_folder . $new_image;

    if ($image_size > 2000000) {
      $warning_msg[] = 'Image size is too large!';
    } else {
      $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
      $update_image->execute([$new_image, $pid]);
      move_uploaded_file($image_tmp_name, $image_path);
      unlink($image_folder . $old_image);
      $success_msg[] = 'Image updated successfully!';
    }
  }
}

?>

<!-- HTML and CSS styling -->


<style type='text/css'>
  <?php include '../style.css'; ?><?php include '../style.scss'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gada Electronics</title>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <!-- Google fonts Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <?php include('./admin_header.php') ?>

  <section class="update-product">

    <h1 class="heading">Update Product</h1>

    <?php
    $update_id = $_GET['update'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_products->execute([$update_id]);
    if ($select_products->rowCount() > 0) {
      while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
          <input type="hidden" name="old_image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
          <div class="image-container">
            <div class="main-image">
              <img src="data:image;base64,<?php echo base64_encode($fetch_products['image']); ?>" alt="" class="img">
              <br>
              <span><b>Update Image</b></span>
              <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            </div>
          </div>
          <div class="right">
            <span><b>Update Name</b></span>
            <input type="text" name="name" required class="box" maxlength="100" placeholder="Enter product name" value="<?= $fetch_products['name']; ?>">
            <span><b>Update Price</b></span>
            <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="Enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
            <span><b>Update Details</b></span>
            <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['product_detail']; ?></textarea>
            <div class="flex-btn">
              <input type="submit" name="update" class="btn" value="Update">
              <a href="admin_products.php" class="option-btn btn">Go Back</a>
            </div>
          </div>
        </form>

    <?php
      }
    } else {
      echo '<p class="empty">No product found!</p>';
    }
    ?>

  </section>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>


</body>

</html>