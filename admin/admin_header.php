<header class="header">
  <nav class="flex">
    <a href="./admin/admin_dashboard.php" class="logo">Admin<span>Panel</span></a>
    <div class="navbar">
      <a href="../admin/admin_dashboard.php">home</a>
      <a href="../admin/products.php">products</a>
      <a href="../admin/placed_orders.php">orders</a>
      <a href="../admin/admin_accounts.php">admins</a>
      <a href="../admin/users_accounts.php">users</a>
      <a href="../admin/messages.php">messages</a>
    </div>

    <div class="icons">
      <i class="bx bxs-user" id="user-btn2"></i>
    </div>
    <div class="user-box ">
      <p>username : <span><?php //echo $_SESSION['admin_name']; 
                          ?></span></p>
      <a href="admin_login.php" class="btn">Login</a>
      <a href="register.php" class="btn">Register</a>
      <form method="post">
        <button type="submit" name="logout" class="logout-btn">Log out</button>
      </form>
    </div>
  </nav>

</header>