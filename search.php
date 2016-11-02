<?php 
//load database connection
    $host = "localhost";
    $user = "root";
    $password = "kieran1";
    $database_name = "travelnetwork";
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
// Search from MySQL database table
$search=$_POST['search'];
if ($search == NULL){
	echo 'Please search something';
} else {
$query = $pdo->prepare("select * from users where firstName LIKE '%$search%' OR lastName LIKE '%$search%'  LIMIT 0 , 10");
$query->bindValue(1, "%$search%", PDO::PARAM_STR);
$query->execute();
// Display search result
         if (!$query->rowCount() == 0) {
		 		echo "Search found :<br/>";
				echo "<table style=\"font-family:arial;color:#333333;\">";	
                echo "<tr><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">First Name</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">Last Name</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;background:#98bf21;\">D.O.B</td></tr>";				
            while ($results = $query->fetch()) {
				echo "<tr><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";			
                echo $results['firstName'];
				echo "</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";
                echo $results['lastName'];
				echo "</td><td style=\"border-style:solid;border-width:1px;border-color:#98bf21;\">";
                echo $results['dob'];
				echo "</td></tr>";				
            }
				echo "</table>";		
        } else {
            echo 'Nothing found';
        }
}
?>