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
  <!-- Google fonts Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- ------------------------------CSS------------------------ -->
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudfare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->



</head>

<body>
  <?php include 'components/header.php'; ?>
  <div class="main">

    <section class="home-section">
      <div class="slider">
        <div class="slider__slider slide1">
          <div class="overlay"></div>
          <div class="slider-cover">
            <video autoplay muted loop id="myVideo">
              <source src="./img/electronicImgs/homeSecVid1.webm" type="video/mp4">
            </video>
            <div class="slide-detail">
              <h1> Galaxy S24 Ultra </h1>
              <p>Get up to $19,999 instant trade-in credit</p>
              <h4><a href="view_products.php?category=mobile">Shop now</a></h4>
            </div>
          </div>
          <div class="hero-dec-top"></div>
          <div class="hero-dec-bottom"></div>
        </div>
        <!-- ---slide end--- -->
        <div class="slider__slider slide2">
          <div class="overlay"></div>
          <div class="slider-cover">
            <img src="/img/electronicImgs/apple watch large.jpg" alt="">
            <div class="slide-detail">
              <span><img src="./img/electronicImgs/apple.png" alt=""></span>
              <h1>WATCH</h1>
              <h3>SERIES 9</h3>
              <h1>Smarter. Brighter.</h1>
              <h1>
                Mightier.
              </h1>
              <a href="view_products.php?category=watch">Shop now &gt;</a>
            </div>
          </div>
          <div class="hero-dec-top"></div>
          <div class="hero-dec-bottom"></div>
        </div>
        <!-- ---slide end--- -->
        <div class="slider__slider slide3">
          <div class="overlay"></div>
          <div class="slider-cover">
            <img src="/img/electronicImgs/home-refrigerator.webp" alt="">
            <div class="slide-detail">
              <h1>New Mega</h1>
              <h1>Capacity fridge</h1>
              <p>With up to 12% more capacity than 2022 models and up to four</p>
              <h4><a href="view_products.php?category=homeAppliances">Shop now</a></h4>
            </div>
          </div>
          <div class="hero-dec-top"></div>
          <div class="hero-dec-bottom"></div>
        </div>
        <!-- ---slide end--- -->
        <div class="slider__slider slide4">
          <div class="overlay"></div>
          <div class="slider-cover">
            <img src="./img/electronicImgs/icons8-ps.png" class="ps5" alt="">
            <video autoplay muted loop id="myVideo2">
              <source src="./img/electronicImgs/ps5-slim-overview-video.mp4" type="video/mp4">
            </video>
            <div class="slide-detail">
              <h1>PLAY LIKE NEVER BEFORE</h1>
              <h4><a href="view_products.php?category=games">Shop now</a></h4>
            </div>
          </div>
          <div class="hero-dec-top"></div>
          <div class="hero-dec-bottom"></div>
        </div>
        <!-- ---slide end--- -->
        <div class="slider__slider slide5">
          <div class="overlay"></div>
          <div class="slider-cover">
            <div class="slide-detail">

              <a href="view_products.php?category=watch">
                <img src="./img/electronicImgs/home-watch-cover.webp" alt="">
              </a>
            </div>
          </div>
          <div class="hero-dec-top"></div>
          <div class="hero-dec-bottom"></div>
        </div>
        <!-- ---slide end--- -->
        <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
        <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
      </div>
    </section>
    <!-- ---home slide end--- -->

    <section class="advertisement">
      <div class="ad">
        <div class="Addetail">
          <div class="ADimg"></div>
          <div class="ADtext">
            <h3>Upto 50% Off on Fully Automatic Top Load Washing Machines</h3>
            <p>Many variations of passages of Lorem ipsum available, but majority have suffered alteration in some form, by injected.</p>
          </div>
        </div>
        <a href="view_products.php?category=homeAppliances">
          <button class="Adbtn">Shop now</button>
        </a>
      </div>
    </section>


    <section class="shop-category align">
      <div class="flex">
        <div class="box">
          <img src="./img/electronicImgs/canonCamera2.jpg" alt="">
          <div class="detail">
            <span>BIG OFFERS</span>
            <h1>Extra 15% off</h1>
            <p>On Canon</p>
            <a href="view_products.php?category=headphones" class='btn'>
              Shop now
            </a>
          </div>
        </div>
        <div class="box">
          <img src="./img/electronicImgs/headphones.jpg" alt="">
          <div class="detail">
            <span>Best Seller</span>
            <h1>Philips R37</h1>
            <h3><strike>&#8377;1999</strike></h3>
            <a href="" class='btn'>
              Shop now
            </a>
          </div>
        </div>
      </div>
    </section>


    <?php include 'categories.php'; ?>


    <!-- <section class="thumb">
      <div class="box-container">
        <div class="box">
          <img src="./img/thumb2.jpg" alt="">
          <h3>Television</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit.</p>
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
          <img src="./img/thumb0.jpg" alt="">
          <h3>Home Appliances</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit.</p>
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
          <img src="./img/thumb1.jpg" alt="">
          <h3>Laptops & Printers</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit.</p>
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
          <img src="./img/thumb.jpg" alt="">
          <h3>Mobiles & Accessories</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit.</p>
          <i class="bx bx-chevron-right"></i>
        </div>
      </div>
    </section> -->

    <!-- Watch Banner -->
    <section class='container align'>
      <a href="view_products.php?category=watch">
        <div class="box-container">
          <div class="box box-left">
            <img src="./img/electronicImgs/AdWatch1.png" alt="">
          </div>
          <div class="box box-mid">
            <span>BEST DIGITAL</span>
            <h1>SALE SMARTWATCH</h1>
            <h3><i>&#x20B9;999/-</i> OFF
            </h3>
          </div>
          <div class="box box-right">
            <img src="./img/electronicImgs/AdWatch.png" alt="">
          </div>
        </div>
      </a>
    </section>

    <!-- Trending Products -->
    <section class="shop">
      <div class="title">
        <h1>Trending Products</h1>
      </div>
      <div class="row">
        <a href="view_products.php?category=games">
          <img src="./img/electronicImgs/PS5.jpg" alt="">
          <div class="detail">
            <h1>New PS5</h1>
            <h4>Get 10% off</h4>
          </div>
        </a>
        <div class="row-detail">
          <a href="view_products.php?category=earphones">
            <img src="./img/electronicImgs/Noise.jpg" alt="">
          </a>
          <div class="top-footer">
            <h1>Lorem ipsum dolor sit amet adipisicing.</h1>
          </div>
        </div>
      </div>
      <div class="box-container">
        <div class="box">
          <a href="view_products.php?category=watch">
            <img src="./img/electronicImgs/apple watch1.jpg" alt="">
            <div class="product-detail">
              <h3>Apple Watch SE</h3>
              <p>From <b>$249</b></p>
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=laptop">
            <img src="./img/electronicImgs/apple watch2.jpg" alt="">
            <div class="product-detail">
              <h3>Apple Watch Series 9</h3>
              <p>From <b>$399</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=watch">
            <img src="./img/electronicImgs/apple watch3.jpg" alt="">
            <div class="product-detail">
              <h3>Apple Watch Ultra 2</h3>
              <p>From <b>$249</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=mobile">
            <img src="./img/electronicImgs/Galaxy-S23-Ultra.webp" alt="">
            <div class="product-detail">
              <h3>Galaxy-S23-Ultra</h3>
              <p>From <b>$349</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=mobile">
            <img src="./img/electronicImgs/galaxy-s24.avif" alt="">
            <div class="product-detail">
              <h3>Galaxy-S23-Ultra</h3>
              <p>From <b>$349</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=homeAppliances">
            <img src="./img/electronicImgs/washing machine2.png" alt="">
            <div class="product-detail">
              <h3>Galaxy-S23-Ultra</h3>
              <p>From <b>$349</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=homeAppliances">
            <img src="./img/electronicImgs/refrigerator.png" alt="">
            <div class="product-detail">
              <h3>Galaxy-S23-Ultra</h3>
              <p>From <b>$349</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
        <div class="box">
          <a href="view_products.php?category=games">
            <img src="./img/electronicImgs/PlayStationPng.png" alt="">
            <div class="product-detail">
              <h3>Galaxy-S23-Ultra</h3>
              <p>From <b>$349</b></p>
              <!-- <a href="view_products.php" class='btn'>Shop now</a> -->
            </div>
          </a>
        </div>
      </div>
    </section>


    <section class="services">
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

    <section class="brand">
      <div class="box-container">
        <div class="box">
          <img src="./img/electronicImgs/boAt_logo.svg" alt="">
        </div>
        <div class="box">
          <img src="./img/electronicImgs/Sony_logo.webp" alt="">
        </div>
        <div class="box">
          <img src="./img/electronicImgs/whirlpool.svg" alt="">
        </div>
        <div class="box">
          <img src="./img/electronicImgs/Samsung-logo.webp" alt="">
        </div>
        <div class="box">
          <img src="./img/electronicImgs/PlayStation_logo.webp" alt="">
        </div>
      </div>
    </section>

    <section class=""></section>
    <?php include 'components/footer.php'; ?>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./script.js"></script>
  <?php include 'components/alert.php'; ?>


</body>

</html>