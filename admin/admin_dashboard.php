<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location: admin_login.php');
}

?>

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
  <section class="dashboard">
    <h1 class="heading">dashboard</h1>
    <div class="box-container">
      <!-- <div class="box">
        <h3>welcome!</h3>
        <p><?= $fetch_profile['name']; ?></p>
        <a href="update_profile.php" class="btn">update profile</a>
      </div> -->

      <!-- Total Sales -->
      <div class="box">
        <?php
        $total_sales = 0;
        $select_sales = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
        $select_sales->execute(['delivered']);

        // $total_pendings = $select_pendings->rowCount();
        if ($select_sales->rowCount() > 0) {
          while ($fetch_sales = $select_sales->fetch(PDO::FETCH_ASSOC)) {
            $total_sales += $fetch_sales['price'];
          }
        }
        ?>
        <p>total Sales</p>
        <h3><span>$</span><?= $total_sales; ?><span>/-</span></h3>
        <a href="placed_orders.php?status" class="btn">see orders</a>
      </div>


      <!-- pendings -->
      <div class="box">
        <?php
        $total_pendings = 0;
        $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
        $select_pendings->execute(['pending']);

        $total_pendings = $select_pendings->rowCount();
        // if ($select_pendings->rowCount() > 0) {
        //   while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
        //     $total_pendings += $fetch_pendings['price'];
        //   }
        // }
        ?>
        <p>total pendings</p>
        <h3><?= $total_pendings; ?></h3>
        <a href="placed_orders.php?status=pending" class="btn">see orders</a>
      </div>
      <!-- completed orders -->
      <div class="box">
        <?php
        $total_completes = 0;
        $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
        $select_completes->execute(['delivered']);
        $total_completes = $select_completes->rowCount();
        // if ($select_completes->rowCount() > 0) {
        //   while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
        //     $total_completes += $fetch_completes['price'];
        //   }
        // }
        ?>
        <p>completed orders</p>
        <h3><?= $total_completes; ?></h3>
        <a href="placed_orders.php?status=delivered" class="btn">see orders</a>
      </div>


      <!-- Placed orders -->
      <div class="box">
        <?php
        $select_orders = $conn->prepare("SELECT * FROM `orders`");
        $select_orders->execute();
        $number_of_orders = $select_orders->rowCount();
        ?>
        <p>orders placed</p>
        <h3><?= $number_of_orders; ?></h3>
        <a href="placed_orders.php?status" class="btn">see orders</a>
      </div>


      <!-- added product -->
      <div class="box">
        <?php
        $select_products = $conn->prepare("SELECT * FROM `products`");
        $select_products->execute();
        $number_of_products = $select_products->rowCount();
        ?>
        <p>products added</p>
        <h3><?= $number_of_products; ?></h3>
        <a href="admin_products.php" class="btn">see products</a>
      </div>

      <!-- Users -->
      <div class="box">
        <?php
        $select_users = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();
        $number_of_users = $select_users->rowCount();
        ?>
        <p>Users</p>
        <h3><?= $number_of_users; ?></h3>
        <a href="user_account.php" class="btn">see users</a>
      </div>


      <!-- admin -->
      <div class="box">
        <?php
        $select_admins = $conn->prepare("SELECT * FROM `admin`");
        $select_admins->execute();
        $number_of_admins = $select_admins->rowCount();
        ?>
        <p>admin users</p>
        <h3><?= $number_of_admins; ?></h3>
        <a href="admin_accounts.php" class="btn">see admins</a>
      </div>


    </div>

  </section>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>
</body>

</html>