<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

//    $name = mysqli_real_escape_string($conn, $_POST['name']);
//    $number = $_POST['number'];
//    $email = mysqli_real_escape_string($conn, $_POST['email']);
//    $method = mysqli_real_escape_string($conn, $_POST['method']);
//    $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
//    $placed_on = date('d-M-Y');

   $selected_total = 0;
   $selected_resources[] = '';

   $selected_query = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($selected_query) > 0){
      while($selected_item = mysqli_fetch_assoc($selected_query)){
         $selected_resources[] = $selected_item['name'];
        //  $sub_total = ($selected_item['price'] * $selected_item['quantity']);
         $selected_total += $sub_total;
      }
   }

   $total_products = implode(', ',$selected_resources);

   $order_query = mysqli_query($conn, "SELECT * FROM `requests` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($selected_total == 0){
      $message[] = 'Your selected resources are empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Resources already selected!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `requests`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Resources selected successfully!';
         mysqli_query($conn, "DELETE FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Checkout</h3>
        <p> <a href="home.php">home</a> / checkout </p>
    </div>

    <section class="display-order">

        <?php  
      $select_selected = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_selected) > 0){
         while($fetch_selected = mysqli_fetch_assoc($select_selected)){
   ?>
        <p> <?php echo $fetch_selected['name']; ?>
        </p>
        <?php
      }
   }else{
      echo '<p class="empty">Selection is empty</p>';
   }
   ?>

    </section>

    <section class="checkout">

        <!-- <form action="" method="post">
            <h3>place your order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>your name :</span>
                    <input type="text" name="name" required placeholder="enter your name">
                </div>
                <div class="inputBox">
                    <span>your number :</span>
                    <input type="number" name="number" required placeholder="enter your number">
                </div>
                <div class="inputBox">
                    <span>your email :</span>
                    <input type="email" name="email" required placeholder="enter your email">
                </div>
                <div class="inputBox">
                    <span>payment method :</span>
                    <select name="method">
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                        <option value="paytm">paytm</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>address line 01 :</span>
                    <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
                </div>
                <div class="inputBox">
                    <span>address line 01 :</span>
                    <input type="text" name="street" required placeholder="e.g. street name">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name="city" required placeholder="e.g. mumbai">
                </div>
                <div class="inputBox">
                    <span>state :</span>
                    <input type="text" name="state" required placeholder="e.g. maharashtra">
                </div>
                <div class="inputBox">
                    <span>country :</span>
                    <input type="text" name="country" required placeholder="e.g. india">
                </div>
                <div class="inputBox">
                    <span>pin code :</span>
                    <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
                </div>
            </div>
            <input type="submit" value="order now" class="btn" name="order_btn">
        </form> -->

    </section>









    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>