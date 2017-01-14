<?php

 // this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO or MySQLi.
 
$servername = "localhost";
$username = "root";
$password = "Multiread23";
$dbname = "mydb";
 
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if($conn->connect_error){
	die("Connection Error: " . $conn->connect_error);
}
echo "Connected succesfully<br>";
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }

 ?>