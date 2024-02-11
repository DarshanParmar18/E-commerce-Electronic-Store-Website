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

// adding products in wishlist
if (isset($_POST['add_to_wishlist'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $varify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $varify_wishlist->execute([$user_id, $product_id]);

    $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $cart_num->execute([$user_id, $product_id]);

    if ($varify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'Products already exist in your wishlist';
    } else if ($cart_num->rowCount() > 0) {
        $warning_msg[] = 'Product already exist in your cart';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id,price) VALUES(?,?,?,?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
        $success_msg[] = 'Product added to wishlist successfully';
    }
}

// adding products in cart
if (isset($_POST['add_to_cart'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $qty = $_POST['qty'];
    $qty = strip_tags($qty);

    $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $varify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if ($varify_cart->rowCount() > 0) {
        $warning_msg[] = 'Products already exist in your cart';
    } else if ($max_cart_items->rowCount() > 20) {
        $warning_msg[] = 'Cart is full!';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id,price, qty) VALUES(?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
        $success_msg[] = 'Product added to cart successfully';
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
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Shop</h1>
        </div>
        <div class="title2">
            <a href="./home.php"><span>Our shop</span></a>
        </div>

        <section class="products">
            <div class="box-container">
                <?php
                $select_products = $conn->prepare('SELECT * FROM `products`');
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form action="" method="post" class="box">
                            <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>">
                                <!-- <?php echo '<img src="data:image;base64,' . base64_encode($fetch_products['image']) . '" alt="" class="img">' ?> -->

                                <!-- the correct way -->
                                <img src="data:image;base64,<?php echo base64_encode($fetch_products['image']); ?>" alt="" class="img">

                                <div class=" button">
                                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                    <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bxs-show"></a>
                                </div>
                                <div class="detail">
                                    <h4 class="name"><?= $fetch_products['name']; ?></h4>
                                    <i class="str bx bxs-star"></i>
                                    <i class="str bx bxs-star"></i>
                                    <i class="str bx bxs-star"></i>
                                    <i class="str bx bxs-star"></i>
                                    <i class="str bx bxs-star-half"></i>
                                    <span class="str">4312</span>
                                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                                    <div class="flex">
                                        <p class="price"> <sup>₹</sup><?= $fetch_products['price']; ?>/- <span style="font-size: 14px;">M.R.P: ₹<strike>12000</strike>(22% off)</span></p>
                                        <!-- <input type="number" name="qty" value="1" required min="1" max="99" maxlength="2" class="qty"> -->
                                    </div>
                                    <p class="fd"><b>Free</b> delivery by <i>GE</i></p>
                                </div>

                            </a>

                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
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