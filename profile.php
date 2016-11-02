<?php
session_start();
$db_user = 'root';
$db_pass = 'kieran1';
$db_name = 'travelnetwork';
$db_host = 'localhost';

$todaysdate = date("Y-m-d");

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($sql);
$sql2 = "SELECT * FROM posts WHERE username = '$username'";
$result2 = $mysqli->query($sql2);

?>
<!DOCTYPE html>
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
    <p>jenny</p>
        
         <div class="container">
            <div class="row">
                <div class="col-md-4">
                <table class="text-center">
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ?>
            <tr>
                <td style="outline: thin solid black;"><img src="images/profile.jpg"></td>
            </tr>
            <tr class="color">
                <td><strong><?php echo $row['firstName'] ." " . $row['lastName']; ?></strong></td>
            </tr>
            <tr class="color">
                <td><strong><span class="glyphicon glyphicon-globe"></span><?php echo " " . $row['currentLocation']; ?></strong></td>
            </tr>
            <tr class="color">
            	<td><strong><?php echo $row['dob']; ?></strong> </td>
            </tr>
            <?php
                }
            }
            else {
                ?>
            <tr class="text-center">
                <td class="text-center"><strong>There's no Posts</strong></td>
            </tr>
            <?php
            }
            ?>
            </table>
                </div>
                <div class="col-md-8 color">
                <h3 class="text-center"><?php echo $_SESSION['username'] . "'s". " " ?>Timeline</h3>
                <table class="text-center table">
                <?php
            if($result2->num_rows > 0){
                while($row = $result2->fetch_assoc()){
                    ?>
            <tr class="color">
                <td><strong><?php echo " " . $row['post']; ?></strong></td>
            	<td><strong><?php echo $row['post_date']; ?></strong> </td>
            </tr>
            <tr><td></td></tr>
            <?php
                }
            }
            else {
                ?>
            <tr>
                <td class="text-center"><strong>There's no Posts</strong></td>
            </tr>
            <?php
            }
            ?>    
                </table>
                <table class="text-center table">
                	<tr class="color">
                    	<td class="text-center"><strong>New Posts</strong></td>
                    </tr>
                    <tr>
                    	<td>
                        	<form action="insert_post.php" method="post">
                        	<textarea name="post" value="New Post" style="width: 100%"></textarea><br />
                            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" name="date" value="<?php echo $todaysdate; ?>">
                        	<input type="submit" name="submit" value="submit">
                            </form> 
                        </td>
                    </tr>
                </table>
        	</div>
            </div>
                </div>
        
    
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </body>
</html>