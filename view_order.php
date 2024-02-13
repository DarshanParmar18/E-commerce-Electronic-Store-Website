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
if (isset($_GET['get_id'])) {
  $get_id = $_GET['get_id'];
} else {
  $get_id = '';
  header('location: order.php');
}
if (isset($_POST['cancel'])) {
  $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id=?");
  $update_order->execute(['canceled', $get_id]);
  header('location: order.php');
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
      <a href="./index.php"><span>Orders details</span></a>
    </div>

    <section class="order-detail">
      <div class="title">
        <img src="./img/download.png" alt="" class="logo">
        <h1>Orders details</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni obcaecati, perferendis voluptatibus corrupti porro illo.</p>
      </div>

      <div class="box-container">
        <?php
        $grand_total = 0;
        $select_orders = $conn->prepare('SELECT * FROM `orders` WHERE id =? LIMIT 1');
        $select_orders->execute([$get_id]);
        if ($select_orders->rowCount() > 0) {
          while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            $select_product = $conn->prepare('SELECT * FROM `products` WHERE id = ? LIMIT 1');
            $select_product->execute([$fetch_order['product_id']]);
            if ($select_product->rowCount() > 0) {
              while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                $grand_total += $sub_total;
        ?>
                <div class="box">
                  <div class="col">
                    <p class="title"><i class='bx bxs-calendar-alt'></i><?= $fetch_order['date']; ?></p>
                    <img src="data:image;base64,<?php echo base64_encode($fetch_product['image']); ?>" alt="" class="img">
                    <p class="price"><?= $fetch_product['price']; ?> X <?= $fetch_order['qty']; ?></p>
                    <h3 class="name"><?= $fetch_product['name']; ?> </h3>
                    <p class="grand-total">Total amount payable : <span>$<?= $grand_total; ?></span></p>
                  </div>
                  <div class="col">
                    <p class="title">billing address</p>
                    <p class="user"><i class="bx bxs-person-bounding-box"></i><?= $fetch_order['name'] ?></p>
                    <p class="user"><i class="bi bi-phone"></i><?= $fetch_order['number']; ?></p>
                    <p class="user"><i class="bi bi-envelope"></i><?= $fetch_order['email']; ?></p>
                    <p class="user"><i class="bi bi-pin-map-fill"></i><?= $fetch_order['address']; ?></p>
                    <p class="title">Status</p>
                    <p class="status" style="color: <?php if ($fetch_order['status'] == 'delivered') {
                                                      echo 'green';
                                                    } elseif ($fetch_order['status'] == 'canceled') {
                                                      echo 'red';
                                                    } else {
                                                      echo 'orange';
                                                    } ?>"><?= $fetch_order['status'] ?></p>
                    <?php
                    if ($fetch_order['status'] == 'canceled') { ?>
                      <a href="checkout.php?get_id=<?= $fetch_order['id']; ?>" class="btn">order again</a>
                    <?php
                    } else { ?>
                      <form action="" method="post">
                        <button class="btn" type="submit" name="cancel" onclick="return confirm('do you want to cancel this order')">Cancel order</button>
                      </form>
                    <?php
                    }
                    ?>

                  </div>
                </div>
        <?php
              }
            } else {
              echo '<p class="empty">product not found</p>';
            }
          }
        } else {
          echo '<p class="empty"> no order found</p>';
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