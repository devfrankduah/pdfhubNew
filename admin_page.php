<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="styles/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">Admin Dashboard</h1>

        <div class="box-container">


            <div class="box">
                <?php
            $select_requests = mysqli_query($conn, "SELECT * FROM `requests`") or die('query failed');
            $number_of_requests = mysqli_num_rows($select_requests);
            ?>
                <h3><?php echo $number_of_requests; ?></h3>
                <p>Requests Made </p>
            </div>

            <div class="box">
                <?php
            $select_resources = mysqli_query($conn, "SELECT * FROM `resources`") or die('query failed');
            $number_of_resources = mysqli_num_rows($select_resources);
            ?>
                <h3><?php echo $number_of_resources; ?></h3>
                <p>Resources added</p>
            </div>

            <div class="box">
                <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>Normal users</p>
            </div>

            <div class="box">
                <?php
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
            ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admin users</p>
            </div>

            <div class="box">
                <?php
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>Total Accounts</p>
            </div>

            <div class="box">
                <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
            ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>New Messages</p>
            </div>

        </div>

    </section>

    <!-- admin dashboard section ends -->









    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>