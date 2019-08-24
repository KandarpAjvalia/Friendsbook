<?php
require 'config/config.php';

// if the session is set, set the user's username
if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($connection, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}
?>

<html>
<head>
    <title>Welcome to Friendsbook</title>

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/71db4d34ca.js"></script>

    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Friendsbook</a>

        </div>

        <nav>
            <a href="#">
                <?php
                echo $user['firstname'];
                ?>
            </a>

            <a href="index.php">
                <i class="fas fa-stream"></i>
            </a>

            <a href="#">
                <i class="fas fa-user-friends"></i>
            </a>
            
            <a href="#">
                <i class="fas fa-comments"></i>
            </a>
                        
            <a href="#">
                <i class="fas fa-bell"></i>
            </a>
            <a href="#">
               <i class="fas fa-cog"></i>
            </a>

            <a href="#">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </nav>
    </div>