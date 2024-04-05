<?php
include("../components/connection.php");
session_start();
if (isset($_SESSION['admin_id'])) {
  $admin_id = $_SESSION['admin_id'];
} else {
  $admin_id = '';
}



if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $name = strip_tags($name);
  $pass = sha1($_POST['pass']);
  $pass = strip_tags($pass);
  $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
  $select_admin->execute([$name, $pass]);
  $row = $select_admin->fetch(PDO::FETCH_ASSOC);
  if ($select_admin->rowCount() > 0) {

    $_SESSION['admin_id'] = $row["id"];
    $_SESSION["admin_name"] = $row["name"];
    $_SESSION["admin_pass"] = $row["pass"];
    echo 'login successful!';
    $success_msg[] = 'login successful!';
    header('location: admin_dashboard.php');
  } else {
    echo 'incorrect username and password';
    $error_msg[] = 'incorrect username or password!';
    header('location: admin_login.php');
  }
}
?>



<style type='text/css'>
  <?php include '../style.css'; ?>
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
  <div class="main-container">
    <div class="form-container">
      <div class="title">
        <h1>Login Now</h1>
      </div>
      <form action="admin_login.php" method="post">
        <div class="input-field">
          <p>Your Name <sup>*</sup></p>
          <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <div class="input-field">
          <p>Your password <sup>*</sup></p>
          <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '') ">
        </div>
        <input type="submit" name='submit' value="login now" class="btn">
        <!-- <p>don't have an account ? </p><a href="register.php">Register now</a> -->
      </form>
    </div>
  </div>


  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./admin_script.js"></script>
  <?php include '../components/alert.php'; ?>
</body>

</html>