<?php

global $conn;
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$select_user->execute([$_SESSION['email']]);
$row = $select_user->fetch(PDO::FETCH_ASSOC);

if($select_user->rowCount() > 0) {
    $message[] = 'Email already exists!';
    header("Location: user_register.php");
}

$randomNumber = rand(100000, 999999);

$to = $_SESSION['email'];
$subject = "Verification code";
$message = "This is the code: " . $randomNumber . "<br>";
$headers = "From: abdallahdaher785@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

$mailSuccess = mail($to, $subject, $message, $headers);

if(isset($_POST['submit'])) {
    if(isset($_SESSION['rand']) && $_SESSION['rand'] == $_POST['code']) {
        $name = $_SESSION['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_SESSION['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_SESSION['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password) VALUES (?,?,?)");
        $insert_user->execute([$name, $email, $pass]);
        $message[] = 'Registered successfully, please login now!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verification</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php';$_SESSION['rand']=$randomNumber; ?>

<section class="form-container">

    <form action="" method="post">
        <h3>Verification</h3>
        <p>Enter the 6-digits from your email</p>
        <input type="number" name="code" required placeholder="enter 6-digits" maxlength="6"  class="box">
        <input type="submit" value="register now" class="btn" name="submit">
        <p>already have an account?</p>
        <a href="user_login.php" class="option-btn">login now</a>
    </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>