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
<title>Transaction History</title>
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
	<li><a href="update.php">Update</a></li>
	<li><a href="index.php">Balance by Loc</a></li>
	<li><a class="active" href="transactions.php">Transactions</a></li>
	<li><a href="delete.php">Delete</a></li>
	<li><a href="export.html">Export</a></li>
	<li><a href="logout.php?logout">Logout</a></li>
</ul>

<form id="addmv" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="update">
<select id="option1" name="option">
  <option value="SerialNumber" name="serialize">Serial</option>
  <option value="Location" name="location">Locatie</option>
  <!--<option value="ups" name="ups">UPS</option>
  <option value="scaner" name="scaner">Scaner</option>
  <option value="pc" name="pc">PC</option>
  <option value="compimp" name="compimp">Componente Imprimanta</option>
  <option value="comppc" name="comppc">Componente PC</option>-->
</select><br>
<input id="loc1" type="text" name="loc"><br>
<input id="sub3" type="submit" name="submit" value="Submit" /><br>
<table class="t1">
	<tr id="tr">
	<thead>
		<th id="th1">Serial Number</th>
		<th id="th2">Descriere</th>
		<th id="th3">Locatie</th>
		<th id="th4">AMG</th>
		<th id="th5">Status</th>
		<th id="th6">Capex</th>
		<th id="th7">NR Invetar FAR</th>
		<th id="th8">Observatii</th>
		<th id="th9">Pret</th>
		<th id="th10">Date/Time</th>
		<th id="th11">User</th>
		<th id="th12">Reason</th>
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

//update tables
if(isset($_POST['submit'])){
	$option = $_POST['option'];
	$location = $_POST['loc'];
	//echo $option . "<br>";
	//echo $location . "<br>";

	$sql_query = "SELECT *, UNIX_TIMESTAMP(date_time) AS DATE FROM transactions WHERE ". $option ."='".$location."' ORDER BY DATE DESC LIMIT 10";
	//echo $sql_query;
	
	$result = $conn->query($sql_query);
	
	while($row_1 = $result -> fetch_assoc()){
			 echo "<tr>
			 <th>" . $row_1["SerialNumber"]."</th>". 
			 "<th>" . $row_1["Descriere"]. "</th>".
			 "<th>" . $row_1["Location"]. "</th>".
			 "<th>" . $row_1["amg"]. "</th>".
			 "<th>" . $row_1["Status"]. "</th>".
			 "<th>" . $row_1["Capex"]. "</th>" .
			 "<th>" . $row_1["nr_inv_far"]. "</th>".
			 "<th>" . $row_1["observatii"]. "</th>".
			 "<th>" . $row_1["Pret"]. "</th>".
			 "<th>" . $row_1["date_time"]. "</th>".
			 "<th>" . $row_1["user"]. "</th>" .
			 "<th>" . $row_1["reason"]. "</th></tr>" ;
			 //continue;
	
		}
}

$conn->close();
?>

</div>
</body>
</html>