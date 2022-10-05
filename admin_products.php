<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $item = $_FILES['item']['name'];
   $item_size = $_FILES['item']['size'];
   $item_tmp_name = $_FILES['item']['tmp_name'];
   $item_folder = 'resources/'.$item;

   $select_resources_name = mysqli_query($conn, "SELECT name FROM `resources` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_resources_name) > 0){
      $message[] = 'Resources name already added';
   }else{
      $add_resources_query = mysqli_query($conn, "INSERT INTO `resources`(name, item) VALUES('$name', '$item')") or die('query failed');

      if($add_resources_query){
         if($item_size > 200000000){
            $message[] = 'Resource size is too large';
         }else{
            move_uploaded_file($item_tmp_name, $item_folder);
            $message[] = 'Resource added successfully!';
         }
      }else{
         $message[] = 'Resource could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_item_query = mysqli_query($conn, "SELECT item FROM `resources` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_item = mysqli_fetch_assoc($delete_item_query);
   unlink('resources/'.$fetch_delete_item['item']);
   mysqli_query($conn, "DELETE FROM `resources` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_resources'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   // $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `resources` SET name = '$update_name' WHERE id = '$update_p_id'") or die('query failed');

   $update_item = $_FILES['update_item']['name'];
   $update_item_tmp_name = $_FILES['update_item']['tmp_name'];
   $update_item_size = $_FILES['update_item']['size'];
   $update_folder = 'resources/'.$update_item;
   $update_old_item = $_POST['update_old_item'];

   if(!empty($update_item)){
      if($update_item_size > 2000000){
         $message[] = 'item file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `resources` SET item = '$update_item' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_item_tmp_name, $update_folder);
         unlink('resources/'.$update_old_item);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="styles/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- product CRUD section starts  -->

    <section class="add-products">

        <h1 class="title">Site Resources</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add Resources</h3>
            <input type="text" name="name" class="box" placeholder="Enter file name" required>
            <!-- <input type="number" min="0" name="price" class="box" placeholder="enter product price" required> -->
            <input type="file" name="item" class="box" required>
            <input type="submit" value="add resource" name="add_product" class="btn">
        </form>

    </section>

    <!-- product CRUD section ends -->

    <!-- show products  -->

    <section class="show-products">

        <div class="box-container">

            <?php
         $select_resources = mysqli_query($conn, "SELECT * FROM `resources`") or die('query failed');
         if(mysqli_num_rows($select_resources) > 0){
            while($fetch_resources = mysqli_fetch_assoc($select_resources)){
      ?>
            <div class="box">
                <img src="resources/<?php echo $fetch_resources['item']; ?>" alt="">
                <div class="name"><?php echo $fetch_resources['name']; ?></div>
                <a href="admin_products.php?update=<?php echo $fetch_resources['id']; ?>" class="option-btn">Update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_resources['id']; ?>" class="delete-btn"
                    onclick="return confirm('Delete this item?');">Delete</a>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">No resources added yet!</p>';
      }
      ?>
        </div>

    </section>

    <section class="edit-product-form">

        <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `resources` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_item" value="<?php echo $fetch_update['item']; ?>">
            <img src="resources/<?php echo $fetch_update['item']; ?>" alt="">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
                placeholder="Enter file name">
            <input type="file" class="box" name="update_item">
            <input type="submit" value="update" name="update_resources" class="btn">
            <input type="reset" value="cancel" id="close-update" class="option-btn">
        </form>
        <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

    </section>







    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>