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

if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM users WHERE user_id =" .$_GET['edit_id'];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
}

if(isset($_POST['btn_update'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
	$image = $_POST['image'];
    $dob = $_POST['dob'];
    $update = "UPDATE users SET username = '$username', password = '$password', email = '$email', dob = '$dob', image = '$image' WHERE user_id=" .$_GET['edit_id'];
    $up = $mysqli->query($update);
if(isset($sql)){
    
        header("location: welcome.php");
    }
}
?>
<html>
    <head>
        <title>Travel Network - Edit</title>
    </head>
    <body>
        <form method="post">
            <label>Username:</label><input type="text" name="username" value="<?php echo $row['username']; ?>"> <br />
            <label>Password:</label><input type="password" name="password" value="<?php echo $row['password']; ?>"> <br />
            <label>Email:</label><input type="text" name="email" value="<?php echo $row['email']; ?>"> <br />
            <label>File: </label><input type="file" name="image" value="<?php echo $row['image']; ?>"> <br />
            <label>Date of Birth: </label><input type="date" name="dob" value="<?php echo $row['dob']; ?>"> <br />
            <button type="submit" name="btn_update" id="btn_update" onClick="update()">Update</button>
        </form>
        <p>The changes will take place when logged out and back in</p>
    </body>
</html>