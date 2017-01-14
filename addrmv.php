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
<title>Add</title>
<link rel="stylesheet" type="text/css" href="inventory.css">
<?php sessionTimeOut(); 
$session = $_SESSION['user'];
echo "Bine ai venit " .$session;
?>
</head>
<body>
<h2>Label Team Inventory System</h2>

<ul>
	<li><a href="mysqltest.php">Balance</a></li>
	<li><a class="active" href="addrmv.php">Add</a></li>
	<li><a href="update.php">Update</a></li>
	<li><a href="index.php">Balance by Loc</a></li>
	<li><a href="delete.php">Delete</a></li>
	<li><a href="export.html">Export</a></li>
	<li><a href="transactions.php">Transactions</a></li>
	<li><a href="logout.php?logout">Logout</a></li>
</ul>
<form id="addmv" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="addmv">
Serial Number* <input id="serial" type="text" name="serial"></input><br>
Descriere* <input id="desc" type="text" name="desc"></input><br>
Locatie* <input id="loc" type="text" name="loc"><br>
Status* <input id="status" type="text" name="status"><br>
Capex <input id="capex" type="text" name="capex"><br>
Nr. Inventar FAR <input id="far" type="text" name="far"><br>
Observatii <input id="obs" type="text" name="obs"><br>
*Campuri obligatorii<br>
<select id="option" name="option">
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
<input id="sub2" type="submit" name="submit" value="Submit" /><br>
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
$reason = "ADD";
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if($conn->connect_error){
	die("Connection Error: " . $conn->connect_error);
}
//echo "Connected succesfully<br>";

//insert into tables example
if(isset($_POST['submit'])){
	if(empty($_POST["serial"] and $_POST["desc"] and $_POST["loc"] and $_POST["status"])){
		echo "Va rog completati campurile obligatorii!";
	}else{
		$str1 = $_POST["serial"];
		$str2 = $_POST["desc"];
		$str3 = $_POST["loc"];
		$str4 = $_POST["status"];
		$str5 = $_POST['capex'];
		$str6 = $_POST['far'];
		$str7 = $_POST['obs'];

		$str1 = strtoupper($str1);
		$str2 = strtoupper($str2);
		$str3 = strtoupper($str3);
		$str4 = strtoupper($str4);
		$str5 = strtoupper($str5);
		$str6 = strtoupper($str6);
		$str7 = strtoupper($str7);
		$serial = $str1;
		
	$sql = "INSERT INTO ".$_POST['option']." (SerialNumber, Descriere, Location, Status, Capex, nr_inv_far, observatii)
	VALUES ('".$str1."', '".$str2."', '".$str3."', '".$str4."','".$str5."','".$str6."','".$str7."')";
	$sql_1 = "INSERT INTO transactions (SerialNumber, Descriere, Location, Status, Capex, nr_inv_far, observatii)
	VALUES ('".$str1."', '".$str2."', '".$str3."', '".$str4."','".$str5."','".$str6."','".$str7."')";
	$sql_2 = "UPDATE transactions SET `user`='".$session."' WHERE SerialNumber = '".$str1."'";
	$sql_3 = "SELECT `id` FROM `transactions` WHERE `SerialNumber` = '".$serial."' ORDER BY `id` DESC LIMIT 0,1";
	$result = $conn->query($sql_3);
	$row = $result->fetch_assoc();
	$id = $row['id'];

	
if($conn->query($sql) === TRUE && $conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE){
	
	$sql_3 = "SELECT `id` FROM `transactions` WHERE `SerialNumber` = '".$serial."' ORDER BY `id` DESC LIMIT 0,1";
	$result = $conn->query($sql_3);
	$row = $result->fetch_assoc();
	$id = $row['id'];
	$sql_4 = "UPDATE transactions SET `reason`='".$reason."' WHERE `id`='".$id."'";
	if($conn->query($sql_4) === TRUE){
		echo "I did it!<br>";
	}
	
} else {
	echo "I didn't do it because:<br> " .$conn->error;
}
/*if($conn->query($sql_1) === TRUE){
	echo "Succesfully inserted into table1<br>";
	
} else {
	echo "Error inserting into table1:<br> " .$conn->error;
}
if($conn->query($sql_2) === TRUE){
	echo "Succesfully inserted into table2<br>";
	
} else {
	echo "Error inserting into table2:<br> " .$conn->error;
}*/
}
}

$conn->close();
?>
</div>
</body>
</html>