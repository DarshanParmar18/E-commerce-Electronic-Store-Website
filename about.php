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
            <h1>About us</h1>
        </div>
        <div class="title2">
            <a href="./home.php"><span>About</span></a>
        </div>
        <div class="about-category">
            <div class="box">
                <img src="./img/3.webp" alt="">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="./img/about.png" alt="">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="./img/1.webp" alt="">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="./img/1.webp" alt="">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
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

        <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="./img/3.png" alt="">
                </div>
                <div class="detail">
                    <h1>Visit our beautiful showroom!</h1>
                    <p>Our showroom is an expression of what we love doing, being creative with floral and plant
                        arrangements.
                        Whether you are looking for a florist for your perfect wedding, or just want to uplift any room
                        with
                        some one of a kind living decor, Blossom With Love can help.
                    </p>
                    <a href="./view_products.php" class='btn'>Shop now</a>
                </div>
            </div>
        </div>

        <div class="testimonial-container">
            <div class="title">
                <img src="./img/download.png" alt="" class="logo">
                <h1>What people say about us</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci?</p>
            </div>
            <div class="container">
                <div class="testimonial-item active">
                    <img src="./img/01.jpg" alt="">
                    <h1>Sara Smith</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus aliquid adipisci labore dolores excepturi obcaecati Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="testimonial-item ">
                    <img src="./img/02.jpg" alt="">
                    <h1>Sara Smith</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus aliquid adipisci labore dolores excepturi obcaecati Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="testimonial-item ">
                    <img src="./img/03.jpg" alt="">
                    <h1>Sara Smith</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus aliquid adipisci labore dolores excepturi obcaecati Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="left-arrow" onclick="prevSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                <div class="right-arrow" onclick="nextSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
            </div>
        </div>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudfare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'components/alert.php'; ?>
    <script src="./script.js"></script>
</body>

</html>