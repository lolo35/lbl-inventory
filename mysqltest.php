<?php
ob_start();
session_start();
 //require_once 'dbconnect.php';
  // if session is not set this will redirect to login page
 if(!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
 }
 
function sessionTimeOut(){
	$logLength = 900;
	$ctime = strtotime("now");
	if(!isset($_SESSION['sessionX'])){
		$_SESSION['sessionX'] = $ctime;
		}else{
			if((strtotime("now") - $_SESSION['sessionX']) > $logLength){
				session_destroy();
				header("Location: login.php");
				exit;
			}else{
				$_SESSION['sessionX'] = $ctime;
			}
		}
}

 ?>
<html>
 
<head>
<title>Balance</title>
<link rel="stylesheet" type="text/css" href="inventory.css">
<?php sessionTimeOut(); 
$session = $_SESSION['user'];
echo "Bine ai venit " .$session;
?>
</head>
<body>

<h2>Label Team Inventory System</h2>
 
<ul>
    <li><a class="active" href="mysqltest.php">Balance</a></li>
    <li><a href="addrmv.php">Add</a></li>
    <li><a href="update.php">Update</a></li>
    <li><a href="index.php">Balance by Loc</a></li>
    <li><a href="delete.php">Delete</a></li>
    <li><a href="export.html">Export</a></li>
	<li><a href="transactions.php">Transactions</a></li>
	<li><a href="logout.php?logout">Logout</a></li>
</ul>
<form id="balance" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="balance">
 
<select id="select" name="option">
  <option value="monitor" name="monitor">Monitor</option>
  <option value="imprimanta" name="imprimanta">Imprimanta</option>
  <option value="ups" name="ups">UPS</option>
  <option value="scaner" name="scaner">Scaner</option>
  <option value="pc" name="pc">PC</option>
  <option value="compimp" name="compimp">Componente Imprimanta</option>
  <option value="comppc" name="comppc">Componente PC</option>
  <option value="amg_assets" name="amg_assets">AMG Assets</option>
  <option value="turn_aps" name="turn_aps">Turn APS</option>
</select><br>
<input id="sub1" type="submit" name="submit" value="Submit" /><br>
 
<table class="t1">
    <tr id="tr">
    <thead>
        <th id="th1">Serial Number</th>
        <th id="th2">Descriere</th>
        <th id="th3">Locatie</th>
		<th id="th9">AMG</th>
        <th id="th4">Status</th>
        <th id="th5">Capex</th>
        <th id="th6">Numar Inventar FAR</th>
		<th id="th7">Observatii</th>
		<th id="th8">Pret</th>
		
    </thead>
    </tr>
<?php 
 
$servername = "localhost";
$dbname = "mydb";

if($session === "Raul Filimon" or $session === "Casian Buta"){
	$username = "root";
	$password = "Multiread23";
}else{
	$username = "generic_user";
	$password = "AYVkq4^Sb=YFBvu+";
}
 
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
//check connection
if($conn->connect_error){
    die("Connection Error: " . $conn->connect_error);
}
//echo "Connected succesfully<br>";
/*Create Database
$sql = "CREATE DATABASE myDB";
 
if($conn->query($sql) === TRUE){
    echo "Database created successfully";
} else {
    echo "<br>Error creating database: " .$conn->error;
}*/
 
/*sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) PRIMARY KEY AUTO_INCREMENT,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";*/
 
//insert into tables example
/*$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
 
if($conn->query($sql) === TRUE){
    echo "Succesfully inserted into table<br>";
} else {
    echo "Error inserting into table:<br> " .$conn->error;
}*/
if(isset($_POST['submit'])){
     
$sql = "SELECT SerialNumber, Descriere, Location, AMG, Status, Capex, nr_inv_far, observatii, Pret FROM ".$_POST['option']."";
$result = $conn->query($sql);
 
if($result->num_rows > 0){
    //output data for each row
    while($row = $result->fetch_assoc()){
        echo "<tr><tbody> 
         <td>" . $row["SerialNumber"]."</td>". 
         "<td>" . $row["Descriere"]. "</td>".
         "<td>" . $row["Location"]. "</td>".
		 "<td>" . $row["AMG"] . "</td>".
         "<td>" . $row["Status"]. "</td>".
         "<td>" . $row["Capex"]. "</td>".
         "<td>" . $row["nr_inv_far"]. "</td>".
		 "<td>" . $row["observatii"]. "</td>".
		 "<td>" . $row["Pret"]. "</td></tbody></tr>";
    }
}else {
    echo "0 results";
}
}
$conn->close();

?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>