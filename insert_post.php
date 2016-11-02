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

$post = mysqli_real_escape_string ($mysqli, $_POST['post']);
$username = mysqli_real_escape_string ($mysqli, $_POST['username']);
$date = mysqli_real_escape_string ($mysqli, $_POST['date']);

$sql = "INSERT INTO posts (post, username, post_date) VALUES ('$post', '$username', '$date')";

if ($mysqli->query($sql) === TRUE) {
    echo 'record added successfully';
    header ("location: profile.php");
} else {
    echo 'error' . $sql . "<br />" . $mysqli->error;
}

$mysqli->close();

?>