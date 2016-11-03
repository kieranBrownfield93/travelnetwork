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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="60">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Travel Network</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
    <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="welcome.php">Travel Network</a>
            </div>
             <form class="navbar-form navbar-left" method="POST" action="search.php">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Search">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="#"><?php if(isset($_SESSION['username'])) { echo "Welcome " .$_SESSION['username']; } ?></a> </li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="edit.php" class="glyphicon glyphicon-cog"></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    John
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