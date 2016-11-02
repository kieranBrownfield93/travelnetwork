<?php
session_start();

$db_user = 'root';
$db_pass = 'kieran1';
$db_name = 'travelnetwork';
$db_host = 'localhost';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if(isset($_SESSION['isLoggedIn'])) {
     header("Location: welcome.php"); // redirects them to homepage
}

if(isset($_POST['submit'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    {
    $sql = "SELECT * FROM users WHERE BINARY username = '".$_POST['username']. "' AND password = '" .$_POST['password']."'";
    $query = mysqli_query($mysqli, $sql);
    $result = mysqli_fetch_assoc($query);
    if($result){
        if(!empty($_POST['remember'])){
            setcookie ("username", $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie ("password", $_POST['password'], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE['username'])){
                setcookie("username", "");
            } if(isset($_COOKIE['password'])){
                setcookie("password", "");
            } 
        }
        
        $_SESSION['isLoggedIn'] = 'TRUE';
        
        
        header ("location: welcome.php");
    }
    
    else{
        $msg = "invalid username or password";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

<body>

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
                <a class="navbar-brand" href="#">Travel Network</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- /.navbar-collapse -->
                  <form class="navbar-form navbar-right" action="login.php" method="post">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
           <input type="text" name="username" value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username'];}  ?>">                                        
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
           <input type="password" name="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];}  ?>">                                        
                        </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                        <p><?php if(isset($msg)) { echo $msg;} ?></p>
                   </form>
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>