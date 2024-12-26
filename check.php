<?php
global $conn;
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:user_login.php');
    exit; // Terminate script execution after redirection
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check out</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart">
    <h3 class="heading">Check out</h3>

    <div class="box-container">
        <?php
        if(isset($_POST['todel'])){
            $countRecords = $conn->prepare("DELETE FROM `check-car` WHERE user_id  = ? ");
            $countRecords->execute([$user_id]);
        }
        if(isset($_POST['car_id2'])) {

            $countRecords = $conn->prepare("DELETE FROM `check-car` WHERE user_id  = ? AND car_id  = ?");
            $countRecords->execute([$user_id, $_POST['car_id2']]);
        }
        $select_cart = $conn->prepare("SELECT * FROM `check-car` WHERE `user_id` = ?");
        $select_cart->execute([$user_id]);

        $cart_row = $select_cart->fetch(PDO::FETCH_ASSOC);

        if ($cart_row) {
            $select_cart->execute([$user_id]);

            while ($cart_row = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                $car_id = $cart_row['car_id'];

                $select = $conn->prepare("SELECT * FROM `car` WHERE `id` = ?");
                $select->execute([$car_id]);

                $car = $select->fetch(PDO::FETCH_ASSOC);

                ?>
                <div class="swiper-slide box" id="checkcar">

                    <img src="<?php echo $car['img']; ?>" alt="Car Image">
                    <h3><?php echo $car['car_name']; ?></h3>
                    <p><?php echo $car['description']; ?></p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">$<?php echo $car['price']; ?></div>
                    <form method="post" action="">
                        <input type="hidden" name="car_id2" value="<?php echo $car['id']; ?>">
                        <button type="submit" name="delete">Remove from List</button>
                    </form>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">Your Check-out page is empty</p>';
        }
        ?>
    </div>

    <div class="cart-total">
        <a href="main-page-car.php" class="option-btn">Continue to see more cars</a>
        <form method="post" action="">
        <input  class="delete-btn" type="submit"  id="open" value="Delete all items">
            <input type="hidden" value="1" name="todel">
        </form>
        <a href="main-page-car.php" class="btn">Proceed to checkout</a>


    </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>

</html>
