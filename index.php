<?php
$con = mysqli_connect("localhost", "root", "", "socialmediadatabase");

if(mysqli_connect_errno()) {
    echo "Failed to connect".mysqli_connect_error();
}
//$query = mysqli_query($con, "INSERT INTO test VALUES('', 'Kandarp')");

?>

<html>
<head>
    <title>Kandarp</title>
</head>
<body>
Hello Kandarp!!
</body>
</html>
