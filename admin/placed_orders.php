<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_POST['update_payment'])) {
  $order_id = $_POST['order_id'];
  $order_status = $_POST['payment_status'];
  $order_status = strip_tags($order_status);
  $update_payment = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
  $update_payment->execute([$order_status, $order_id]);
  // $message[] = 'payment status updated!';
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
  $delete_order->execute([$delete_id]);
  header('location:placed_orders.php');
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
  <span class="error-msg"><?php
                          $order_status = $_GET['status'];
                          ?></span>
  <?php include('./admin_header.php') ?>

  <section class="admin_orders">

    <h1 class="heading">
      <?php

      if ($order_status == 'pending') {
      ?>Pending orders<?php
                    } else if ($order_status == 'delivered') {
                      ?>Completed orders<?php
                                      } else {
                                        ?>Placed orders<?php
                                                      }
                                                        ?>
    </h1>

    <!-- Search form -->
    <form action="" method="GET" class="search-form">
      <input type="text" name="search_term" placeholder="Search orders...">
      <button type="submit" class="btn">Search</button>
    </form>

    <div class="box-container">

      <?php
      // Fetch orders based on search term or order status
      $search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';
      $select_orders = $conn->prepare("SELECT orders.*, products.name AS product_name, products.image AS product_image FROM `orders` INNER JOIN `products` ON orders.product_id = products.id WHERE orders.status LIKE ? AND (orders.id LIKE ? OR orders.method LIKE ? OR orders.name LIKE ? OR products.name LIKE ?)");
      $select_orders->execute(["%$order_status%", "%$search_term%", "%$search_term%", "%$search_term%", "%$search_term%"]);

      if ($select_orders->rowCount() > 0) {
        while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="box">
            <div class="order-img">
              <img src="data:image;base64,<?php echo base64_encode($fetch_orders['product_image']); ?>" alt="Product Image">
            </div>
            <div class="right">
              <p><b>Order ID : </b><span><?= $fetch_orders['id']; ?></span> </p>
              <p><b>Placed on : </b><span><?= $fetch_orders['date']; ?></span> </p>
              <p><b>Product Name : </b><span><?= $fetch_orders['product_name']; ?></span> </p>
              <p><b>Name : </b><span><?= $fetch_orders['name']; ?></span> </p>
              <p><b>Number : </b><span><?= $fetch_orders['number']; ?></span> </p>
              <p><b>Address : </b><span><?= $fetch_orders['address']; ?></span> </p>
              <p><b>Quantity : </b><span><?= $fetch_orders['qty']; ?></span> </p>
              <p><b>Total price : </b><span>$<?= $fetch_orders['price']; ?>/-</span> </p>
              <p><b>Payment method : </b><span><?= $fetch_orders['method']; ?></span> </p>
            </div>
            <form action="" method="post">
              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
              <select name="payment_status" class="select">
                <option selected disabled><?= $fetch_orders['status']; ?></option>
                <option value="pending">pending</option>
                <option value="delivered">completed</option>
              </select>
              <div class="flex fbtns">
                <input type="submit" value="update" class="option-btn btn" name="update_payment">
                <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn btn" onclick="return confirm('delete this order?');">delete</a>

            </form>
          </div>
    </div>
<?php
        }
      } else {
        echo '<p class="empty">no orders placed yet!</p>';
      }
?>

  </section>

  </section>


  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>

</body>

</html>