<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "socialmediadatabase");

if(mysqli_connect_errno()) {
    echo "Failed to connect".mysqli_connect_error();
}

// variables for register form
$firstName = "";
$lastName = "";
$email = "";
$confirmEmail = "";
$password = "";
$confirmPassword = "";
$signupDate = "";
$error_array = array();

if(isset($_POST['register_button'])) {

    // registeration form values
    
    // remove html tags
    $firstName = strip_tags($_POST['reg_firstname']);

    // remove spaces
    $firstName = str_replace(' ', '', $firstName);

    // uppercase first letter
    $firstName = ucfirst(strtolower($firstName));

    // set session variable
    $_SESSION['reg_firstname'] = $firstName;
    
    $lastName = strip_tags($_POST['reg_lastname']);

    $lastName = str_replace(' ', '', $lastName);

    $lastName = ucfirst(strtolower($lastName));
    $_SESSION['reg_lastname'] = $lastName;

    $email = strip_tags($_POST['reg_email']); 

    $email = str_replace(' ', '', $email);

    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email'] = $email;

    $confirmEmail = strip_tags($_POST['reg_confirmemail']); 

    $confirmEmail = str_replace(' ', '', $confirmEmail);

    $confirmEmail = ucfirst(strtolower($confirmEmail));
    $_SESSION['reg_confirmemail'] = $confirmEmail;

    $password = strip_tags($_POST['reg_password']); 

    $confirmPassword = strip_tags($_POST['reg_confirmpassword']); 
    
    // current date
    $signupDate = date("Y-m-d");

    if($email == $confirmEmail) {
        // check if the email is in valid format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            // check if email already exists
            $emailCheck = mysqli_query($connection, "SELECT email FROM users WHERE email='$email'");

            // number of rows returned
            $numRows = mysqli_num_rows($emailCheck);
            if($numRows > 0) {
                array_push($error_array, "Email already in use, please use a different email<br>");
            }
        }
        else {
            array_push($error_array, "Invalid email format<br>");
        }

    }
    else {
        array_push($error_array, "Emails don't match<br>");
    }

    // field validity checks
    if(strlen($firstName) > 25 || strlen($firstName) < 2) {
        array_push($error_array, "First name must be between 2 and 25 characters<br>");
    }
    
    if(strlen($lastName) > 25 || strlen($lastName) < 2) {
        array_push($error_array, "Last name must be between 2 and 25 characters<br>");
    }

    
    if($password != $confirmPassword) {
        array_push($error_array, "Passwords don't match<br>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Password can only contain alphabets and numbers<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Password must be between 5 and 30 characters<br>");
    }
    
    if(empty($error_array)) {
        // encrypt the password before sending it to the database
        $password = md5($password);

        //generate username by concatenating first name and last name
        $username = strtolower($firstName . "_" . $lastName);
        $checkUsernameQuery = mysqli_query($connection, "SELECT username FROM users WHERE username='$username'");
        
        $i = 0;
        while(mysqli_num_rows($checkUsernameQuery) != 0) {
            $i++;
            $username = $username . "_" . $i;
            $checkUsernameQuery = mysqli_query($connection, "SELECT username FROM users WHERE username='$username'");
        }

        

        // default profile pic
        $profilePic = "assets/images/profile_pics/defaults/default.jpg";
        
        $query = mysqli_query($connection, "INSERT INTO users VALUES ('', '$firstName', '$lastName', '$username', '$email', '$password', '$signupDate', '$profilePic', '0', '0', 'no', ',')");
    }
}
?>

<html>
<head>
    <title>Welcome to FriendsBook</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_firstname" placeholder="First Name" value="<?php 
        if(isset($_SESSION['reg_firstname'])) {
            echo $_SESSION['reg_firstname'];
        }
        ?>" required>
        <br>
        <?php if(in_array("First name must be between 2 and 25 characters<br>", $error_array)) {
            echo "First name must be between 2 and 25 characters<br>";
        }
        ?>

        <input type="text" name="reg_lastname" placeholder="Last Name" value="<?php
        if(isset($_SESSION['reg_lastname'])) {
            echo $_SESSION['reg_lastname'];
        }
        ?>" required>
        <br>
        <?php if(in_array("Last name must be between 2 and 25 characters<br>", $error_array)) {
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
        if(in_array("Email already in use, please use a different email<br>", $error_array)) {
            echo "Email already in use, please use a different email<br>";
        }
        else if(in_array("Invalid email format<br>", $error_array)) {
            echo "Invalid email format<br>";
        }
        else if(in_array("Emails don't match<br>", $error_array)) {
            echo "Emails don't match<br>";
        }
        ?>

        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_confirmpassword" placeholder="Confirm Password" required>
        <br>
        <?php 
        if(in_array("Passwords don't match<br>", $error_array)) {
            echo "Passwords don't match<br>";
        }
        else if(in_array("Password can only contain alphabets and numbers<br>", $error_array)) {
            echo "Password can only contain alphabets and numbers<br>";
        }
        else if(in_array("Password must be between 5 and 30 characters<br>", $error_array)) {
            echo "Password must be between 5 and 30 characters<br>";
        }
        ?>

        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>