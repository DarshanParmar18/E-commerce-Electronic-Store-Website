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
</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Contact us</h1>
        </div>
        <div class="title2">
            <a href="./home.php"><span>Contact us</span></a>
        </div>

        <section class="services">
            <div class="title">
                <img src="./img/download.png" alt="" class="logo">
                <h1>Why Choose us</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore a quos recusandae soluta consequatur cum.</p>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="./img/icon2.png" alt="">
                    <div class="detail">
                        <h3>Great Savings</h3>
                        <p>Save big evey year</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon1.png" alt="">
                    <div class="detail">
                        <h3>24*7 support</h3>
                        <p>one-on-one support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon0.png" alt="">
                    <div class="detail">
                        <h3>Gift vouchers</h3>
                        <p>vouchers on every festival</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon.png" alt="">
                    <div class="detail">
                        <h3>cash on delivery</h3>
                        <p>pay in cash after you receive your order</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="form-container">
            <form method="post" action="">
                <div class="post">
                    <div class="title">
                        <img src="./img/download.png" class="logo" alt="">
                        <h1>Leave a message</h1>
                    </div>
                    <div class="input-field">
                        <p>Your name<sup>*</sup></p>
                        <input type="text" name="name">
                    </div>
                    <div class="input-field">
                        <p>Your email <sup>*</sup></p>
                        <input type="email" name="email">
                    </div>
                    <div class="input-field">
                        <p>Your number <sup>*</sup></p>
                        <input type="text" name="number">
                    </div>
                    <div class="input-field">
                        <p>Your message <sup>*</sup></p>
                        <textarea name="message"></textarea>
                    </div>
                    <button type="submit" name="submit-btn" class="btn">Send message</button>
                </div>
            </form>
        </div>
        <div class="address">
            <div class="title">
                <img src="./img/download.png" class="logo" alt="">
                <h1>Contact details</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
            <div class="box-container">
                <div class="box">
                    <i class="bx bxs-map-pin"></i>
                    <div>
                        <h4>Address</h4>
                        <p>1092 Merigold Lane, Coral Way</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-phone-call"></i>
                    <div>
                        <h4>Phone number</h4>
                        <p>8530113011</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-map-pin"></i>
                    <div>
                        <h4>Email</h4>
                        <p>darshanparmar123416@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudfare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'components/alert.php'; ?>
    <script src="./script.js"></script>
</body>

</html>