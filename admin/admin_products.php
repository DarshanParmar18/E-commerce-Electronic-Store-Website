<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_POST['add_product'])) {

  $name = strip_tags($_POST['name']);
  $price = strip_tags($_POST['price']);
  $details = strip_tags($_POST['details']);
  $type = strip_tags($_POST['type']);

  $image = $_FILES['image'];
  $image_name = $image['name'];
  $image_tmp_name = $image['tmp_name'];
  $image_size = $image['size'];
  $image_folder = '../img/store/';

  // Check if file is uploaded successfully
  if ($image['error'] !== UPLOAD_ERR_OK) {
    $error_msg[] = 'Failed to upload image.';
  } else {
    // Check file type
    $allowed_types = array('image/jpeg', 'image/png', 'image/webp');
    if (!in_array($image['type'], $allowed_types)) {
      $error_msg[] = 'Only JPG, PNG, and WEBP files are allowed.';
    } elseif ($image_size > 2000000) { // Check file size (2MB limit)
      $error_msg[] = 'File size is too large. Maximum size allowed is 2MB.';
    } else {
      // Generate unique filename
      $image_name = uniqid() . '_' . $image_name;
      $image_path = $image_folder . $image_name;

      // Move uploaded file to destination folder
      if (!move_uploaded_file($image_tmp_name, $image_path)) {
        $error_msg[] = 'Failed to move uploaded file.';
      } else {
        // File uploaded successfully
        $image_blob = file_get_contents($image_path);

        // Insert product into database
        $insert_product = $conn->prepare("INSERT INTO `products` (name, product_detail, price, image, category) VALUES (?, ?, ?, ?, ?)");
        $insert_product->bindParam(1, $name);
        $insert_product->bindParam(2, $details);
        $insert_product->bindParam(3, $price);
        $insert_product->bindParam(4, $image_blob, PDO::PARAM_LOB);
        $insert_product->bindParam(5, $type);
        if ($insert_product->execute()) {
          $success_msg[] = 'New product added successfully!';
        } else {
          // Failed to insert product into database
          // Remove uploaded image if insertion failed
          unlink($image_path);
          $error_msg[] = 'Failed to add product to the database.';
        }
      }
    }
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
  $delete_product->execute([$delete_id]);

  if ($delete_product->rowCount() > 0) {
    $success_msg[] = 'Product deleted successfully!';
  } else {
    $error_msg[] = 'Failed to delete product.';
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

  <section class="add-products">
    <h1 class="heading">Add Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="containe">
        <div class="cont">
          <div class="flex">
            <div class="inputBox">
              <span>product name (required)</span>
              <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
            </div>
            <div class="inputBox">
              <span>product price (required)</span>
              <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
            <div class="inputBox">
              <span>product details (required)</span>
              <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="flex">
            <div class="inputBox">
              <span>Image (required)</span>
              <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
              <span>Product type (required)</span>
              <input type="text" class="box" required maxlength="100" placeholder="enter product type" name="type">
            </div>
          </div>
        </div>
        <input type="submit" value="add product" class="btn" name="add_product">
      </div>
    </form>

  </section>

  <section class="show-products">

    <h1 class="heading">products added</h1>

    <div class="box-container">

      <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="box">
            <img src="data:image;base64,<?php echo base64_encode($fetch_products['image']); ?>" alt="" class="img">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
            <div class="details"><span><?= $fetch_products['product_detail']; ?></span></div>
            <div class="flex-btn">
              <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn btn">update</a>
              <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn btn" onclick="return confirm('delete this product?');">delete</a>
            </div>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }
      ?>

    </div>

  </section>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>

</body>

</html>