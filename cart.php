<?php
include 'components/connection.php';
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}
if (isset($_POST['logout'])) {
  session_destroy();
  header('location: login.php');
}

// update product in cart

if (isset($_POST['update_cart'])) {
  $cart_id = $_POST['$cart_id'];
  $cart_id = strip_tags($cart_id);
  $qty = $_POST['qty'];
  $qty = strip_tags($qty);

  $update_qty = $conn->prepare("UPDATE `cart` SET qty=? WHERE id = ?");
  $update_qty->execute([$qty, $cart_id]);

  $success_msg[] = "cart quantity updated successfully";
}



// delete item from cart

if (isset($_POST['delete_item'])) {
  $cart_id = $_POST['cart_id'];

  $varify_delete_items = $conn->prepare('SELECT * FROM `cart` WHERE id =?');
  $varify_delete_items->execute([$cart_id]);

  if ($varify_delete_items->rowCount() > 0) {
    $delete_cart_id = $conn->prepare('DELETE FROM `cart` WHERE id =?');
    $delete_cart_id->execute([$cart_id]);
    $success_msg[] = "cart item deleted successfully";
  } else {
    $warning_msg[] = "cart item already deleted";
  }
}

// empty cart
if (isset($_POST["empty_cart"])) {
  $varify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? ");
  $varify_empty_item->execute([$user_id]);

  if ($varify_empty_item->rowCount() > 0) {
    $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_id->execute([$user_id]);
    $success_msg[] = "Empty successfully";
  } else {
    $warning_msg[] = "cart item already deleted";
  }
}

?>
<style type='text/css'>
  <?php include 'style.css'; ?>
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
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

</head>

<body>
  <?php include 'components/header.php'; ?>
  <div class="main">
    <div class="banner">
      <h1>Cart</h1>
    </div>
    <div class="title2">
      <a href="./index.php"><span>Cart</span></a>
    </div>

    <section class="products">
      <h1 class="title">products added in cart</h1>
      <div class="box-container">
        <?php
        // 
        $grand_total = 0;
        $select_cart = $conn->prepare('SELECT * FROM `cart` WHERE user_id = ?');
        $select_cart->execute([$user_id]);
        if ($select_cart->rowCount() > 0) {
          while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_cart['product_id']]);
            if ($select_products->rowCount() > 0) {
              $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
        ?>
              <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <img src="data:image;base64,<?php echo base64_encode($fetch_product['image']); ?>" alt="" class="img">
                <h3 class="name"><?= $fetch_product['name']; ?></h3>
                <div class="flex">
                  <p class="price">price: <br> &#x20B9;<?= $fetch_product['price']; ?>/-</p>
                  <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">

                  <button type="submit" name="update_cart" class="bx bxs-edit fa-edit"></button>
                </div>
                <p class="sub-total">Sub total : <span>&#x20B9;<?= $sub_total = ($fetch_cart['qty'] * $fetch_cart['price']) ?></span></p>
                <button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item');">Delete</button>

              </form>
        <?php
              $grand_total += $sub_total;
            } else {
              echo '<p class="empty">Product was not found!</p>';
            }
          }
        } else {
          echo '<p class="empty">no products added yet!</p>';
        }
        ?>
      </div>
      <?php
      if ($grand_total != 0) {
      ?>
        <div class="cart-total">
          <p>total amount payable : <span>&#x20B9;<?= $grand_total; ?>/-</span></p>
          <div class="button">
            <form action="" method="post">
              <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart')">Empty cart</button>
            </form>
            <!-- <a href="checkout.php" class="btn">proceed to checkout</a> -->
            <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">proceed to checkout</a>
          </div>
        </div>
      <?php
      }
      ?>
    </section>


    <?php include 'components/footer.php'; ?>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php include 'components/alert.php'; ?>
  <script src="./script.js"></script>
</body>

</html>