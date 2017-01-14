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
<title>Update</title>
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
	<li><a href="addrmv.php">Add</a></li>
	<li><a class="active" href="update.php">Update</a></li>
	<li><a href="index.php">Balance by Loc</a></li>
	<li><a href="delete.php">Delete</a></li>
	<li><a href="export.html">Export</a></li>
	<li><a href="transactions.php">Transactions</a></li>
	<li><a href="logout.php?logout">Logout</a></li>
</ul>
<hr>
<form id="addmv" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="update">
Serial Number* <input id="serial1" type="text" name="serial"></input><br>
Optiuni* <select id="option2" name="option"><br>
  <option value="SerialNumber" name="SerialNumber">Serial Number</option>
  <option value="Descriere" name="Descriere">Descriere</option>
  <option value="Location" name="Location">Locatie</option>
  <option value="Status" name="Status">Status</option>
  <option value="Capex" name="Capex">Capex</option>
  <option value="nr_inv_far" name="nr_inv_far">Nr. Inventar FAR</option>
  <option value="observatii" name="observatii">Observatii</option>
  <option value="amg" name="amg">AMG</option>
</select><br>

Valoare* <input id="loc1" type="text" name="loc"><br>
*Campuri obligatorii<br>

<input id="sub3" type="submit" name="submit" value="Submit" /><br>
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

//update tables
if(isset($_POST['submit'])){
	$location = $_POST['loc'];
	$serial = $_POST['serial'];
	if($_POST['option'] === "Location"){
	$reason = "UPD_LOC";
	}
	if($_POST['option'] === "Descriere"){
	$reason = "UPD_DSC";
	}
	if($_POST['option'] === "Status"){
	$reason = "UPD_STS";
	}
	if($_POST['option'] === "Capex"){
	$reason = "UPD_CPX";
	}
	if($_POST['option'] === "nr_inv_far"){
	$reason = "UPD_FAR";
	}
	if($_POST['option'] === "observatii"){
	$reason = "UPD_OBS";
	}
	if($_POST['option'] === "amg"){
	$reason = "UPD_AMG";
	}
	if(empty($_POST["serial"] and $_POST["loc"])){
		echo "Va rog completati campurile obligatorii!";
	}else{
	$sql_query1 = "SELECT * FROM monitor WHERE SerialNumber='".$serial."'";
	$result_q1 = $conn->query($sql_query1);
	if($result_q1->num_rows > 0){
		
		$tbname = "monitor";
		
		}
		
	$sql_query2 = "SELECT * FROM compimp WHERE SerialNumber='".$serial."'";
	$result_q2 = $conn->query($sql_query2);
	if($result_q2->num_rows > 0){
		//echo "i found something";
		$tbname = "compimp";
		
		}
	
	$sql_query3 = "SELECT * FROM comppc WHERE SerialNumber='".$serial."'";
	$result_q3 = $conn->query($sql_query3);
	if($result_q3->num_rows > 0){
		//echo "i found something";
		$tbname = "comppc";
		
		}
	
	$sql_query4 = "SELECT * FROM imprimanta WHERE SerialNumber='".$serial."'";
	$result_q4 = $conn->query($sql_query4);
	if($result_q4->num_rows > 0){
		//echo "i found something";
		$tbname = "imprimanta";
		
		}
	
	$sql_query5 = "SELECT * FROM pc WHERE SerialNumber='".$serial."'";
	$result_q5 = $conn->query($sql_query5);
	if($result_q5->num_rows > 0){
		//echo "i found something";
		$tbname = "pc";
		
		}
	
	$sql_query6 = "SELECT * FROM scaner WHERE SerialNumber='".$serial."'";
	$result_q6 = $conn->query($sql_query6);
	if($result_q6->num_rows > 0){
		//echo "i found something";
		$tbname = "scaner";
		
		}
	
	$sql_query7 = "SELECT * FROM ups WHERE SerialNumber='".$serial."'";
	$result_q7 = $conn->query($sql_query7);
	if($result_q7->num_rows > 0){
		//echo "i found something";
		$tbname = "ups";
		
		}
	
	$sql_query8 = "SELECT * FROM amg_assets WHERE SerialNumber='".$serial."'";
	$result_q8 = $conn->query($sql_query8);
	if($result_q8->num_rows > 0){
		//echo "i found something";
		$tbname = "amg_assets";
		
		}
		
	$sql_query9 = "SELECT * FROM turn_aps WHERE SerialNumber='".$serial."'";
	$result_q9 = $conn->query($sql_query9);
	if($result_q9->num_rows > 0){
		$tbname = "turn_aps";
		
		}
	
	$sql = "UPDATE ".$tbname." SET ".$_POST['option']." = '".$location."' WHERE SerialNumber='".$serial."'";
	if($_POST['option'] === "SerialNumber"){
	$reason = "UPD_SRN";
	$serial = $_POST['loc'];
	}
	$sql_1 = "INSERT INTO transactions (SerialNumber, Descriere, Location, Status, Capex, nr_inv_far, observatii)
	SELECT SerialNumber, Descriere, Location, Status, Capex, nr_inv_far, observatii FROM ".$tbname." WHERE SerialNumber='".$serial."'";
	$sql_2 = "UPDATE transactions SET `user`='".$session."' WHERE SerialNumber='".$serial."'";
	

	if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1) && mysqli_query($conn, $sql_2)){
		$sql_3 = "SELECT `id` FROM `transactions` WHERE `SerialNumber` = '".$serial."' ORDER BY `id` DESC LIMIT 0,1";
		$result = $conn->query($sql_3);
		$row = $result->fetch_assoc();
		$id = $row['id'];
		//echo $id;
		$sql_4 = "UPDATE transactions SET `reason`='".$reason."' WHERE `id`='".$id."'";
		if($conn->query($sql_4) === TRUE){
			echo "I did it<br>";
		}
	}else{
		echo "error" .mysqli_error($conn);
	}
	/*if(mysqli_query($conn, $sql_1)){
		echo "I did it1<br>";
	}else{
		echo "error" .mysqli_error($conn);
	}
	if(mysqli_query($conn, $sql_2)){
		echo "I did it2<br>";
	}else{
		echo "error" .mysqli_error($conn);
	}
	if(mysqli_query($conn, $sql_4)){
		echo "I did it4<br>";
	}else{
		echo "error" .mysqli_error($conn);
	}*/
	/*if($conn->query($sql_query1) === TRUE){
		
		echo $result;
	}else{
		echo $conn->error;
	}*/
	//$sql = "UPDATE % SET Location='".$_POST['loc']."' WHERE SerialNumber='".$_POST['serial']."'";

	//if($conn->query($sql) === TRUE){
		//echo "Succesfully inserted into table<br>";
	//} else {
		//echo "Error inserting into table:<br> " .$conn->error;
	//}
}
}
$conn->close();
?>
</div>
</body>
</html>