<?php

if(isset($_POST['login_button'])) {
    
    // email in the correct format
    $email = filter_var($_POST['loginEmail'], FILTER_SANITIZE_EMAIL);
    // store email into a session variable
    $_SESSION['loginEmail'] = $email;
    $password = md5($_POST['loginPassword']);

    $checkDatabaseQuery = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' AND password='$password'");


    $checkLoginQuery = mysqli_num_rows($checkDatabaseQuery);

    if($checkLoginQuery == 1) {
        $row = mysqli_fetch_array($checkDatabaseQuery);
        $username = $row['username'];

        $userClosedQuery= mysqli_query($connection, "SELECT * FROM users WHERE email='$email' AND userclosed='yes'");
        if(mysqli_num_rows($userClosedQuery) == 1) {
            $reopenAccount = mysqli_query($connection, "UPDATE users SET userclosed='no' WHERE email='$email'");
        }

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else {
        array_push($signupLogs, "Email or Password Incorrect<br>");
    }
}

?>