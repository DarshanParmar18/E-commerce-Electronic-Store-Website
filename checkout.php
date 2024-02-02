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
  header("location: login.php");
}
if (isset($_POST["place_order"])) {
  $name = $_POST['name'];
  $name = strip_tags($name);
  $number = $_POST["number"];
  $number = strip_tags($number);
  $email = $_POST['email'];
  $email = strip_tags($email);
  $address = $_POST['flat'] . ' ' . $_POST['street'] . ' ' . $_POST['city'] . ' ' . $_POST['country'] . ' ' . $_POST['pincode'];
  $address = strip_tags($address);
  $address_type = $_POST['address_type'];
  $address_type = strip_tags($address_type);
  $method = $_POST['method'];
  $method = strip_tags($method);

  $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
  $varify_cart->execute([$user_id]);

  // if (isset($_GET["get_id"])) {
  //   $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
  //   $get_product->execute(['get_id']);
  //   if ($get_product->rowCount() > 0) {
  //     while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
  //       $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, $method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
  //       $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
  //       header('location: order.php');
  //     }
  //   } else {
  //     $warning_msg[] = '1something went wrong';
  //   }
  // } else if ($varify_cart->rowCount() > 0) {
  //   while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)) {
  //     $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, $method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
  //     $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
  //     header('location: order.php');
  //   }
  //   if ($insert_order) {
  //     $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
  //     $delete_cart_id->execute([$user_id]);
  //     header('location: order.php');
  //   }
  // } else {
  //   $warning_msg[] = "2something went wrong";
  // }

  // -------------------------------------------------------
  if (isset($_GET["get_id"])) {
    $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
    $get_product->execute([$_GET['get_id']]);
    if ($get_product->rowCount() > 0) {
      while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
        $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
      }
    } else {
      $warning_msg[] = 'Something went wrong';
    }
  } else if ($varify_cart->rowCount() > 0) {
    while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)) {
      $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], 1]);
    }

    if ($insert_order) {
      $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart_id->execute([$user_id]);
    }
  } else {
    $warning_msg[] = "Something went wrong";
  }

  // Redirect to order.php after processing the order
  header('location: order.php');
  // -------------------------------------------------------


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
      <h1>Checkout Summary</h1>
    </div>
    <div class="title2">
      <a href="./home.php"><span>/ Checkout Summary</span></a>
    </div>

    <section class="checkout">
      <div class="title">
        <img src="./img/download.png" alt="logo" class="logo">
        <h1>Checkout Summary</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id Lorem ipsum dolor sit amet.</p>
      </div>
      <div class="row">
        <form action="" method="post">
          <h3>Billing details</h3>
          <div class="flex">
            <div class="box">
              <div class="input-field">
                <p>Your name<span>*</span></p>
                <input type="text" name="name" required maxlength="50" placeholder="Enter Your name" class="input">
              </div>
              <div class="input-field">
                <p>Your number<span>*</span></p>
                <input type="number" name="number" required maxlength="10" placeholder="Enter Your number" class="input">
              </div>
              <div class="input-field">
                <p>Your email<span>*</span></p>
                <input type="email" name="email" required maxlength="50" placeholder="Enter Your email" class="input">
              </div>
              <div class="input-field">
                <p>Payment method<span>*</span></p>
                <select name="method" class="input">
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit or debit card">credit or debit card</option>
                  <option value="net banking">net banking</option>
                  <option value="UPI or RuPay">UPI or RuPay</option>
                </select>
              </div>
              <div class="input-field">
                <p>address type<span>*</span></p>
                <select name="address_type" class="input">
                  <option value="home">home</option>
                  <option value="office">office</option>
                </select>
              </div>
            </div>
            <div class="box">
              <div class="input-field">
                <p>address line 01<span>*</span></p>
                <input type="text" name="flat" required maxlength="50" placeholder="e.g flat &building number" class="input">
              </div>
              <div class="input-field">
                <p>address line 02<span>*</span></p>
                <input type="text" name="street" required maxlength="50" placeholder="e.g street name" class="input">
              </div>
              <div class="input-field">
                <p>city name<span>*</span></p>
                <input type="text" name="city" required maxlength="50" placeholder="Enter Your city name" class="input">
              </div>
              <div class="input-field">
                <p>country name<span>*</span></p>
                <input type="text" name="country" required maxlength="50" placeholder="Enter Your country name" class="input">
              </div>
              <div class="input-field">
                <p>pincode<span>*</span></p>
                <input type="text" name="pincode" required maxlength="6" placeholder="Enter Your name" min="0" max="99999" class="input">
              </div>
            </div>
          </div>
          <button type="submit" name="place_order" class="btn">Place Order</button>

        </form>
        <div class="summary">
          <h3>my bag</h3>
          <div class="box-container">
            <?php
            $grand_total = 0;
            if (isset($_GET['get_id'])) {
              $select_get = $conn->prepare('SELECT * FROM `products` WHERE id = ? ');
              $select_get->execute([$_GET['get_id']]);
              while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                $sub_total = $fetch_get['price'];
                $grand_total += $sub_total;
            ?>
                <div class="flex">
                  <img src="data:image;base64,<?php echo base64_encode($fetch_get['image']); ?>" alt="" class="img">
                  <div>
                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                    <p class="price"><?= $fetch_get['price']; ?>/-</p>
                  </div>
                </div>
                <?php
              }
            } else {
              $select_cart = $conn->prepare('SELECT * FROM `cart` WHERE user_id = ?');
              $select_cart->execute([$user_id]);
              if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $select_products = $conn->prepare('SELECT * FROM `products` WHERE id = ?');
                  $select_products->execute([$fetch_cart['product_id']]);
                  $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                  $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                  $grand_total += $sub_total;
                ?>
                  <div class="flex">
                    <img src="data:image;base64,<?php echo base64_encode($fetch_product['image']); ?>" alt="" class="img">
                    <div>
                      <h3 class="name"><?= $fetch_product['name']; ?></h3>
                      <p class="price"><?= $fetch_product['price']; ?>X <?= $fetch_cart['qty']; ?></p>
                    </div>
                  </div>
            <?php
                }
              } else {
                echo '<p class="empty" >Your cart is empty</p>';
              }
            }
            ?>
          </div>
          <div class="grand-total"><span>total amount payable : </span>$<?= $grand_total ?>/-</div>
        </div>
      </div>

    </section>


    <?php include 'components/footer.php'; ?>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php include 'components/alert.php'; ?>
  <script src="./script.js"></script>
</body>

</html>