<?php
$db_user = 'root';
$db_pass = 'kieran1';
$db_name = 'travelnetwork';
$db_host = 'localhost';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$username = mysqli_real_escape_string ($mysqli, $_POST['username']);

$password = mysqli_real_escape_string ($mysqli, $_POST['password']);

$email = mysqli_real_escape_string ($mysqli, $_POST['email']);

$firstName = mysqli_real_escape_string ($mysqli, $_POST['firstName']);

$lastName = mysqli_real_escape_string ($mysqli, $_POST['lastName']);

$dob = mysqli_real_escape_string ($mysqli, $_POST['dob']);

$current = mysqli_real_escape_string ($mysqli, $_POST['currentLocation']);

$sql = "INSERT INTO users (username, password, email, firstName, lastName, dob, currentLocation) VALUES ('$username', '$password', '$email', '$firstName', '$lastName', '$dob', '$current')";

if ($mysqli->query($sql) === TRUE) {
    echo 'record added successfully';
    header ("location: index.php");
} else {
    echo 'error' . $sql . "<br />" . $mysqli->error;
}

$mysqli->close();

?>