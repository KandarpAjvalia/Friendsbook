<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
    <title>Welcome to Friendsbook</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>
<body>
    <div class="wrapper">
        
        <div class = "login_box">
            <div class="login_header">
                <h1>Friendsbook</h1>
                Login or Sign Up below
                
            </div>

                <div class="login_content">
                <form action="register.php" method = "POST">
                    <input type="email" name="loginEmail" placeholder="Email" value="<?php 
                    if(isset($_SESSION['loginEmail'])) {
                        echo $_SESSION['loginEmail'];
                    }
                    ?>" required>
                    <input type="password" name="loginPassword" placeholder="Password">
                    <input type="submit" name="login_button" value="Log In">
                    <?php if(in_array("Email or Password Incorrect<br>", $signupLogs)) {
                        echo "Email or Password Incorrect<br>";
                    }
                    ?>
                </form>

                <form action="register.php" method="POST">
                    <input type="text" name="reg_firstname" placeholder="First Name" value="<?php 
                    if(isset($_SESSION['reg_firstname'])) {
                        echo $_SESSION['reg_firstname'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("First name must be between 2 and 25 characters<br>", $signupLogs)) {
                        echo "First name must be between 2 and 25 characters<br>";
                    }
                    ?>

                    <input type="text" name="reg_lastname" placeholder="Last Name" value="<?php
                    if(isset($_SESSION['reg_lastname'])) {
                        echo $_SESSION['reg_lastname'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("Last name must be between 2 and 25 characters<br>", $signupLogs)) {
                        echo "Last name must be between 2 and 25 characters<br>";
                    }
                    ?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php
                    if(isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required>
                    <br>
                    <input type="email" name="reg_confirmemail" placeholder="Confirm Email" value="<?php
                    if(isset($_SESSION['reg_confirmemail'])) {
                        echo $_SESSION['reg_confirmemail'];
                    }
                    ?>" required>
                    <br>
                    <?php 
                    if(in_array("Email already in use, please use a different email<br>", $signupLogs)) {
                        echo "Email already in use, please use a different email<br>";
                    }
                    else if(in_array("Invalid email format<br>", $signupLogs)) {
                        echo "Invalid email format<br>";
                    }
                    else if(in_array("Emails don't match<br>", $signupLogs)) {
                        echo "Emails don't match<br>";
                    }
                    ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_confirmpassword" placeholder="Confirm Password" required>
                    <br>
                    <?php 
                    if(in_array("Passwords don't match<br>", $signupLogs)) {
                        echo "Passwords don't match<br>";
                    }
                    else if(in_array("Password can only contain alphabets and numbers<br>", $signupLogs)) {
                        echo "Password can only contain alphabets and numbers<br>";
                    }
                    else if(in_array("Password must be between 5 and 30 characters<br>", $signupLogs)) {
                        echo "Password must be between 5 and 30 characters<br>";
                    }
                    ?>

                    <input type="submit" name="register_button" value="Sign Up">
                    <br>

                <?php 
                    if(in_array("<span style='color: #14C800;'> Sign Up Complete</span><br>", $signupLogs)) {
                        echo "<span style='color: #0000ff;'> Sign Up Complete</span><br>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>