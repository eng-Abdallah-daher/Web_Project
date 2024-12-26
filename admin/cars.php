<?php
global $conn;
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit; // Terminate script execution after redirection
}

$message = []; // Initialize an empty array for messages

if (isset($_POST['add_car'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../photos/' . $image_01;

    $image_01 = 'photos/'.$_FILES['image_01']['name'];
    $select_products = $conn->prepare("SELECT * FROM car ");
    $select_products->execute();
    $rt= filter_var($select_products->rowCount()+1, FILTER_SANITIZE_STRING);

    // Exclude the auto-incremented primary key column from the INSERT statement
    $insert_products = $conn->prepare("INSERT INTO car (id,car_name, description, price, img) VALUES (?,?, ?, ?, ?)");
    $insert_products->execute([$rt,$name, $details, $price, $image_01]);


    if ($insert_products) {
        $last_inserted_id = $conn->lastInsertId(); // Get the auto-incremented primary key value

        if ($image_size_01 > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            $message[] = 'New product added! (Car ID: ' . ($select_products->rowCount()+1). ')';
            header('Location:dashboard.php');
        }
    } else {
        $message[] = 'Error adding product!';
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        .any1 {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .any1 .any {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: center;
        }

        .any1 .any h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .any1 .any p {
            font-size: 25px;
            margin-bottom: 10px;
        }

        .any1 .any i {
            color: var(--main-color);
            font-size: 14px;
            margin-bottom: 6px;
        }

        .any1 .any .price {
            font-size: 16px;
        }

        .any1 .any .swiper-slide {
            border: 1px solid green;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
            border-radius: 10px;
        }

        .any1 .any .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .any1 .any .swiper-slide * {
            margin: 4px 2px 0 2px;
        }
    </style>

</head>

<body>
<?php include '../components/admin_header.php'; ?>

<section class="add-products">
    <h1 class="heading">Add Cars</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span>Car name (required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter car name" name="name">
            </div>
            <div class="inputBox">
                <span>Car price (required)</span>
                <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter car price" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
            <div class="inputBox">
                <span>Image (required)</span>
                <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
                <span>Car details (required)</span>
                <textarea name="details" placeholder="Enter car details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
        </div>

        <input type="submit" value="Add Car" class="btn" name="add_car">
    </form>
</section>
<div class="any1">
<div class="any">

<?php

// Select cars associated with the user_id from the check-car table
$select = $conn->prepare("SELECT * FROM `car`");

$select->execute();

// Fetch the first row and display the associated car information
$cart_row = $select->fetch(PDO::FETCH_ASSOC);
$numRows = $select->rowCount();


if ($cart_row) {

    // Reset the cursor to the beginning to fetch all rows in the next loop
    $select->execute();

    // Fetch each row and display the associated car information
    while ($cart_row = $select->fetch(PDO::FETCH_ASSOC)) {





            // Display the car details
            ?>
            <div class="swiper-slide box" >
                <form action="" method="post" >
                    <input type="hidden"  id="car_id" name="car_id" value="<?= $cart_row['id']; ?>">
                    <img src="/<?= $cart_row['img']; ?>" style="width: 332.96px;height: 233.9px;" alt="">
                    <h3><?= $cart_row['car_name']; ?></h3>
                    <p><?= $cart_row['description']; ?></p>

                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>


                    </div>

                    <div class="price">$<?= $cart_row['price']; ?></div>


                </form>

            </div>
            <?php
        }
    } else {
    echo '<p class="empty">Your Check-out page is empty</p>';
}
?>

</div>
</div>
<script src="../js/admin_script.js"></script>
</body>

</html>