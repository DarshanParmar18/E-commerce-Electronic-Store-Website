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
      <h1>Order</h1>
    </div>
    <div class="title2">
      <a href="./home.php"><span>Our Order</span></a>
    </div>

    <section class="orders">
      <div class="title">
        <img src="./img/download.png" alt="" class="logo">
        <h1>My orders</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni obcaecati, perferendis voluptatibus corrupti porro illo.</p>
      </div>

      <div class="box-container">
        <?php
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
        $select_orders->execute([$user_id]);
        if ($select_orders->rowCount() > 0) {
          while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_order["product_id"]]);
            if ($select_products->rowCount() > 0) {
              while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="box" <?php if ($fetch_order['status'] == 'canceled') {
                                    echo 'style="border:2px solid red";';
                                  } ?>>
                  <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                    <p class="date"><i class="bi bi-calender-fill"></i><span><?= $fetch_order['date'] ?></span></p>
                    <img src="data:image;base64,<?php echo base64_encode($fetch_product['image']); ?>" alt="" class="img">
                    <div class="row">
                      <h3 class="name"><?= $fetch_product['name']; ?></h3>
                      <p class="price">Price : $<?= $fetch_order['price']; ?> X <?= $fetch_order['qty']; ?></p>
                      <p class="status" style="color:<?php if ($fetch_order['status'] == 'delivered') {
                                                        echo 'green';
                                                      } else if ($fetch_order['status'] == 'canceled') {
                                                        echo 'red';
                                                      } else {
                                                        echo 'orange';
                                                      } ?>"><?= $fetch_order['status']; ?></p>
                    </div>
                  </a>
                </div>
        <?php
              }
            }
          }
        } else {

          echo '<p class="empty"> no order takes placed yet!</p>';
        }
        ?>
      </div>
    </section>


    <?php include 'components/footer.php'; ?>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php include 'components/alert.php'; ?>
  <script src="./script.js"></script>
</body>

</html>