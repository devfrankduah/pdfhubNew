<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>your requested resources</h3>
        <p> <a href="home.php">Home</a> / Requests</p>
    </div>

    <section class="placed-orders">

        <h1 class="title">placed requests</h1>

        <div class="box-container">

            <?php
         $requests_query = mysqli_query($conn, "SELECT * FROM `requests` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($requests_query) > 0){
            while($fetch_requests = mysqli_fetch_assoc($requests_query)){
      ?>
            <div class="box">
                <p> name : <span><?php echo $fetch_requests['name']; ?></span> </p>
                <p> number : <span><?php echo $fetch_requests['number']; ?></span> </p>
                <p> email : <span><?php echo $fetch_requests['email']; ?></span> </p>
                <p> your requests : <span><?php echo $fetch_requests['total_resources']; ?></span> </p>
            </div>
            <?php
       }
      }else{
         echo '<p class="empty">No requests placed yet!</p>';
      }
      ?>
        </div>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>