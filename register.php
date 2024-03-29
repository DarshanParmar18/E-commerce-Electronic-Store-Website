<?php
include 'components/connection.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// register user
if (isset($_POST['submit'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name = strip_tags($name);
    $email = $_POST['email'];
    $email = strip_tags($email);
    $pass = $_POST['pass'];
    $pass = strip_tags($pass);
    $cpass = $_POST['cpass'];
    $cpass = strip_tags($cpass);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $message[] = "email already exist";
        echo 'email already exist';
    } else {
        if ($pass != $cpass) {
            $message[] = "confirm your password";
            echo "confirm your password";
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users` (id,name,email,password) VALUES(?,?,?,?)");
            $insert_user->execute([$id, $name, $email, $pass]);
            header("location: index.php");
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            if ($select_user->rowCount() > 0) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_name"] = $row["name"];
                $_SESSION["user_email"] = $row["email"];
            }
        }
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
</head>

<body>
    <div class="register-container">
        <div class="form-container">
            <div class="title">
                <h1>Register Now</h1>
            </div>
            <form action="" method="post">
                <div class="input-field">
                    <p>Your name <sup>*</sup></p>
                    <input type="text" name="name" required placeholder="Enter your name" maxlength="50">
                </div>
                <div class="input-field">
                    <p>Your email <sup>*</sup></p>
                    <input type="email" name="email" required placeholder="Enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '') ">
                </div>
                <div class="input-field">
                    <p>Your password <sup>*</sup></p>
                    <input type="password" name="pass" required placeholder="Enter your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '') ">
                </div>
                <div class="input-field">
                    <p>Confirm password <sup>*</sup></p>
                    <input type="password" name="cpass" required placeholder="Confirm your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '') ">
                </div>
                <input type="submit" name='submit' value="register now" class="btn">
                <p>already have an account ? </p><a href="login.php">Login now</a>
            </form>
        </div>
        <div class="login-img-container">
            <h1>Gada Electronics</h1>
        </div>
    </div>

</body>

</html>