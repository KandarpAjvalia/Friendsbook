<?php
$con = mysqli_connect("localhost", "root", "", "socialmediadatabase");

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
$error_array = "";

if(isset($_POST['register_button'])) {

    // registeration form values
    
    // remove html tags
    $firstName = strip_tags($_POST['reg_firstname']);

    // remove spaces
    $firstName = str_replace(' ', '', $firstName);

    // uppercase first letter
    $firstName = ucfirst(strtolower($firstName));

    
    $lastName = strip_tags($_POST['reg_lastname']);

    $lastName = str_replace(' ', '', $lastName);

    $lastName = ucfirst(strtolower($lastName));

    $email = strip_tags($_POST['reg_email']); 

    $email = str_replace(' ', '', $email);

    $email = ucfirst(strtolower($email));

    $confirmEmail = strip_tags($_POST['reg_confirmemail']); 

    $confirmEmail = str_replace(' ', '', $confirmEmail);

    $confirmEmail = ucfirst(strtolower($confirmEmail));

    $password = strip_tags($_POST['reg_password']); 

    $confirmpassword = strip_tags($_POST['reg_confirmpassword']); 
    
    // current date
    $signupDate = date("Y-m-d");

    if($email == $confirmEmail) {

    }
    else {
        echo "Emails don't match";
    }
}

?>

<html>
<head>
    <title>Welcome to FriendsBook</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_firstname" placeholder="First Name" required>
        <br>
        <input type="text" name="reg_lastname" placeholder="First Name" required>
        <br>
        <input type="email" name="reg_email" placeholder="Email" required>
        <br>
        <input type="email" name="reg_confirmemail" placeholder="Confirm Email" required>
        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_confirmpassword" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>

