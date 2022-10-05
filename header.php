<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="https://web.facebook.com/esuglegon/?_rdc=1&_rdr" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <img style=" width: 8%; height: 8%;" src="././images/esug.jpg" alt="">
            <nav class=" navbar">
                <a href="home.php">Home</a>
                <a href="shop.php">Resources</a>
                <a href="orders.php">Requests</a>
                <a href="contact.php">Contact</a>
                <a href="about.php">About</a>

            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search_page.php" class="fas fa-search"></a>
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_selected_number = mysqli_query($conn, "SELECT * FROM `selected` WHERE user_id = '$user_id'") or die('query failed');
                $selected_rows_number = mysqli_num_rows($select_selected_number);
                ?>
                <a href="cart.php"> <i class="fas fa-book"></i>
                    <span>(<?php echo $selected_rows_number; ?>)</span>
                </a>
            </div>

            <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">Sign Out</a>
            </div>
        </div>
    </div>

</header>