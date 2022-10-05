<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// if(isset($_POST['update_cart'])){
//    $selected_id = $_POST['selected_id'];
// //    $selected_quantity = $_POST['selected_quantity'];
//    mysqli_query($conn, "UPDATE `` SET quantity = '$selected_quantity' WHERE id = '$selected_id'") or die('query failed');
//    $message[] = 'cart quantity updated!';
// }

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `selected` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Selected Resources</h3>
        <p> <a href="home.php">Home</a> / Selections </p>
    </div>

    <section class="shopping-cart">

        <h1 class="title">Resources added!</h1>

        <div class="box-container">
            <?php
         $select_selected = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_selected) > 0){
            while($fetch_selected = mysqli_fetch_assoc($select_selected)){   
      ?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_selected['id']; ?>" class="fas fa-times"
                    onclick="return confirm('Delete this from selections?');"></a>
                <img src="resources/<?php echo $fetch_selected['item']; ?>" alt="">
                <div class="name"><?php echo $fetch_selected['name']; ?></div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_selected['id']; ?>">
                    <input type="submit" name="update_cart" value="update" class="option-btn">
                </form>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">Your selections are empty</p>';
      }
      ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn"
                onclick="return confirm('Delete all from selections?');">Delete
                all</a>
        </div>

        <div class="cart-total">
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue exploring</a>
                <a href="checkout.php" class="btn">proceed to
                    download</a>
            </div>
        </div>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>