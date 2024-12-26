<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="about">

    <div class="row">

        <div class="image">
            <img src="images/about-img.svg" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>Choose our car company for a driving experience that exceeds expectations. With a legacy of quality and innovation, we prioritize your satisfaction. Our vehicles blend style, performance, and advanced technology seamlessly. Trust us for a reliable, safe, and luxurious journey every time.</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

    </div>

</section>

<section class="reviews">

    <h1 class="heading">client's reviews</h1>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <img src="images/pic-1.png" alt="">
                <p>Exceptional service! I recently purchased a car from this company, and I am extremely satisfied with the entire process. The staff was knowledgeable, friendly, and patient. They helped me find the perfect car within my budget. The after-sales support has been top-notch as well. Highly recommended!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Abdallah Daher</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-2.png" alt="">
                <p>Overall, a positive experience. The showroom was clean and well-organized, and the sales team was professional. They took the time to understand my needs and provided helpful information about the different models. The purchasing process was smooth, and I felt like I got a fair deal. I'm enjoying my new car!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Ibrahim Asad</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-3.png" alt="">
                <p>Great selection of cars and excellent customer service. The staff was friendly and not pushy at all. They let me take my time exploring the options and answered all my questions. The financing process was straightforward, and I felt like they genuinely cared about my satisfaction.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Fadi Hamad</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-4.png" alt="">
                <p>Good experience overall. The staff was courteous, and the showroom had a nice atmosphere. The test drive was enjoyable, and they were upfront about pricing and financing options. My only suggestion would be a bit more transparency about additional fees, but aside from that, I'm happy with my purchase.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Emily R.</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-5.png" alt="">
                <p>Impressed with the professionalism and efficiency of the entire team. From the moment I walked in, I felt like a valued customer. They worked with me to find a car that met my requirements and budget. The paperwork was handled swiftly, and I drove away with confidence.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Alex B.</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-6.png" alt="">
                <p>Decent experience with this car company. The sales team was helpful, and I found a reliable car that fits my needs. The negotiation process was fair, and they were willing to address my concerns. The delivery of the car took a bit longer than expected, hence the four stars.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Karen S.</h3>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

    var swiper = new Swiper(".reviews-slider", {
        loop:true,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable:true,
        },
        breakpoints: {
            0: {
                slidesPerView:1,
            },
            768: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 3,
            },
        },
    });

</script>

</body>
</html>