<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['order_btn'])) {

    $selected_total = 0;
    $selected_resources[] = '';

    $selected_query = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($selected_query) > 0) {
        while ($selected_item = mysqli_fetch_assoc($selected_query)) {
            $selected_resources[] = $selected_item['name'];
            //  $sub_total = ($selected_item['price'] * $selected_item['quantity']);
            $selected_total += $sub_total;
        }
    }

    $total_products = implode(', ', $selected_resources);

    $order_query = mysqli_query($conn, "SELECT * FROM `requests` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($selected_total == 0) {
        $message[] = 'Your selected resources are empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'Resources already selected!';
        } else {
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
        <p> <a href="home.php">Home</a> / Checkout </p>
    </div>

    <section class="display-order">

        <?php
        $select_selected = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_selected) > 0) {
            while ($fetch_selected = mysqli_fetch_assoc($select_selected)) {
                $target_dir = "resources/";
                $target_file = $target_dir . basename($fetch_selected['item']);
                // $book_url =  $row["item"];
                // $book_file = "resources/" $book_url);
                // echo "<a href='$book_url'  download='$book_file'><i class='fa fa-download'></i> </a><hr><br>";

        ?>
        <p> <?php echo $fetch_selected['name'], " - ", $fetch_selected['item'];
                    // $target_dir = "resources/";
                    // $target_file = $target_dir . basename('essien.sql'); 
                    ?>
        </p>
        <a href="resources/<?php echo $fetch_selected['item'] ?>"
            download='resources/ <?php $fetch_selected['item'] ?>'>>Download<i class='fa fa-download'></i></a>

        <?php
            }
        } else {
            echo '<p class="empty">Selection is empty</p>';
        }


        ?>
        <!-- <button type="button" download=<?php $fetch_selected['item'] ?>>Download</button> -->

    </section>

    <section class="checkout">
    </section>


    <!-- 
    <?php
    function retrieveBook()
    {
        include 'config.php';
        $user_id = $_SESSION['user_id'];

        mysqli_select_db($conn, "shop_db");
        $search_query = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
        // output data of each row
        while ($row = mysqli_fetch_array($rows)) {
            $target_dir = "resources/";
            $target_file = $target_dir . basename($fetch_selected['item']);
            $book_url =  $row["item"];
            $book_file = str_replace("resources/", "", $book_url);
            echo "<a href='$book_url'  download='$book_file'><i class='fa fa-download'></i> </a><hr><br>";
        };
    }
    ?> -->





    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>