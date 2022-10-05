<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">Home</a> / About </p>
    </div>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/esug.jpg" alt="">
            </div>

            <div class="content">
                <!-- <h3>why choose us?</h3> -->
                <p>Welcome to the School of Engineering Sciences at University of Ghana. The School of Engineering
                    Sciences was established as the Faculty of Engineering Sciences (FES) in the 2003/2004 Academic Year
                    and welcomed its pioneering batch of 31 students, comprising 26 male and 5 females in August 2004.
                    FES attained its current status as the School of Engineering Sciences (SES) when the University
                    adopted the Collegiate System of Governance in 2014.</p>
                <p>The original mandate of the School was:

                    1. to expand the engineering capacity of Ghana’s public universities,

                    2. to help expand and diversify the University’s curricula,

                    3. to create more opportunities for the increasing number of science students and

                    4. to provide human resources in the selected disciplines and emerging areas of Ghana’s economy for
                    research and industrial application.</p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

        </div>

    </section>

    <!-- <section class="reviews">

        <h1 class="title">client's reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-4.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-5.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-6.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                    quia. Ducimus repudiandae dolore placeat.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

        </div>

    </section> -->

    <!-- <section class="authors">

        <h1 class="title">greate authors</h1>

        <!-- <div class="box-container">

            <div class="box">
                <img src="images/author-1.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/author-2.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/author-3.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/author-4.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/author-5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/author-6.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

        </div> -->

    </section>
    -->






    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>