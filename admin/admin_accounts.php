<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
  $delete_admins->execute([$delete_id]);
  header('location:admin_accounts.php');
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

  <section class="accounts">
    <h1 class="heading">admin accounts</h1>
    <div class="box-container">
      <div class="box">
        <p>add new admin</p>
        <a href="register_admin.php" class="option-btn btn">register admin</a>
      </div>
      <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admin`");
      $select_accounts->execute();
      if ($select_accounts->rowCount() > 0) {
        while ($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="box">
            <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
            <p> admin name : <span><?= $fetch_accounts['name']; ?></span> </p>
            <div class="flex-btn">
              <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn btn">delete</a>
              <?php
              if ($fetch_accounts['id'] == $admin_id) {
                echo '<a href="update_profile.php" class="option-btn">update</a>';
              }
              ?>
            </div>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">no accounts available!</p>';
      }
      ?>

    </div>

  </section>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>

</body>

</html>