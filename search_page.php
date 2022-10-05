<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_POST['add_to_cart'])) {

   $resources_name = $_POST['resources_name'];
   $resources_item = $_POST['resources_item'];

   $check_selected_numbers = mysqli_query($conn, "SELECT * FROM `selected` WHERE name = '$resources_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_selected_numbers) > 0) {
      $message[] = 'Resource already selected!';
   } else {
      mysqli_query($conn, "INSERT INTO `selected`(user_id, name, item) VALUES('$user_id', '$resources_name', '$resources_item')") or die('query failed');
      $message[] = 'Resource selected!';
   }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>search page</h3>
        <p> <a href="home.php">Home</a> / Search </p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="Search resources..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        <div class="box-container">
            <?php
         if (isset($_POST['submit'])) {
            $search_item = $_POST['search'];
            $select_resources = mysqli_query($conn, "SELECT * FROM `resources` WHERE name LIKE '%{$search_item}%'") or die('query failed');
            if (mysqli_num_rows($select_resources) > 0) {
               while ($fetch_resources = mysqli_fetch_assoc($select_resources)) {
         ?>
            <form action="" method="post" class="box">
                <img src="resources/<?php echo $fetch_resources['item']; ?>" alt="" class="image">
                <div class="name"><?php echo $fetch_resources['name']; ?></div>
                <input type="hidden" name="product_name" value="<?php echo $fetch_resources['name']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_resources['item']; ?>">
                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            </form>
            <?php
               }
            } else {
               echo '<p class="empty">No result found!</p>';
            }
         } else {
            echo '<p class="empty">Search something!</p>';
         }
         ?>
        </div>


    </section>









    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>