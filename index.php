<?php
//ob_start();
//session_start();
 //require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 //if(!isset($_SESSION['user'])) {
  //header("Location: index.php");
  //exit;
 //}
 ?>
<html>

<head>
<title>Balance by location</title>
<link rel="stylesheet" type="text/css" href="inventory.css">
</head>
<body>
<h2>Label Team Inventory System</h2>

<ul>
	<li><a href="mysqltest.php">Balance</a></li>
	<li><a href="addrmv.php">Add</a></li>
	<li><a href="update.php">Update</a></li>
	<li><a class="active" href="index.php">Balance by Loc</a></li>
	<li><a href="transactions.php">Transactions</a></li>
	<li><a href="delete.php">Delete</a></li>
	<li><a href="export.html">Export</a></li>
</ul>

<form id="addmv" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="update">
<select id="option1" name="option">
  <option value="Location" name="location">Location</option>
  <option value="SerialNumber" name="serialize">Serial</option>
  <option value="amg" name="amg">AMG</option>
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
	</thead>
	</tr>
<?php
$servername = "localhost";
$username = "generic_user";
$password = "AYVkq4^Sb=YFBvu+";
$dbname = "mydb";

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

	$sql_query1 = "SELECT * FROM monitor WHERE ".$option."='".$location."'";
	$sql_query2 = "SELECT * FROM compimp WHERE ".$option."='".$location."'";
	$sql_query3 = "SELECT * FROM comppc WHERE ".$option."='".$location."'";
	$sql_query4 = "SELECT * FROM imprimanta WHERE ".$option."='".$location."'";
	$sql_query5 = "SELECT * FROM pc WHERE ".$option."='".$location."'";
	$sql_query6 = "SELECT * FROM scaner WHERE ".$option."='".$location."'";
	$sql_query7 = "SELECT * FROM ups WHERE ".$option."='".$location."'";
	$sql_query8 = "SELECT * FROM amg_assets WHERE ".$option."='".$location."'";	
	$sql_query9 = "SELECT * FROM turn_aps WHERE ".$option."='".$location."'";
	
	$result_q1 = $conn->query($sql_query1);
	$result_q2 = $conn->query($sql_query2);
	$result_q3 = $conn->query($sql_query3);
	$result_q4 = $conn->query($sql_query4);
	$result_q5 = $conn->query($sql_query5);
	$result_q6 = $conn->query($sql_query6);
	$result_q7 = $conn->query($sql_query7);
	$result_q8 = $conn->query($sql_query8);
	$result_q9 = $conn->query($sql_query9);
	while($row_1 = $result_q1->fetch_assoc()){
			 echo "<tr>
			 <th>" . $row_1["SerialNumber"]."</th>". 
			 "<th>" . $row_1["Descriere"]. "</th>".
			 "<th>" . $row_1["Location"]. "</th>".
			 "<th>" . $row_1["amg"]. "</th>".
			 "<th>" . $row_1["Status"]. "</th>".
			 "<th>" . $row_1["Capex"]. "</th>" .
			 "<th>" . $row_1["nr_inv_far"]. "</th>".
			 "<th>" . $row_1["observatii"]. "</th>".
			 "<th>" . $row_1["Pret"]. "</th></tr>" ;
			 continue;
	}
			 while($row_2 = $result_q2->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_2["SerialNumber"]."</th>". 
				 "<th>" . $row_2["Descriere"]. "</th>".
				 "<th>" . $row_2["Location"]. "</th>".
				 "<th>" . $row_2["amg"]. "</th>".
				 "<th>" . $row_2["Status"]. "</th>".
				 "<th>" . $row_2["Capex"]. "</th>".
				 "<th>" . $row_2["nr_inv_far"]. "</th>".
				 "<th>" . $row_2["observatii"]. "</th>".
				 "<th>" . $row_2["Pret"]. "</th></tr>" ;
				 continue;
			 }
			  while($row_3 = $result_q3->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_3["SerialNumber"]."</th>". 
				 "<th>" . $row_3["Descriere"]. "</th>".
				 "<th>" . $row_3["Location"]. "</th>".
				 "<th>" . $row_3["amg"]. "</th>".
				 "<th>" . $row_3["Status"]. "</th>".
				 "<th>" . $row_3["Capex"]. "</th>" .
				 "<th>" . $row_3["nr_inv_far"]. "</th>".
				 "<th>" . $row_3["observatii"]. "</th>".
				 "<th>" . $row_3["Pret"]. "</th></tr>" ;
				 continue;
			 }
			 while($row_4 = $result_q4->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_4["SerialNumber"]."</th>". 
				 "<th>" . $row_4["Descriere"]. "</th>".
				 "<th>" . $row_4["Location"]. "</th>".
				 "<th>" . $row_4["amg"]. "</th>".
				 "<th>" . $row_4["Status"]. "</th>".
				 "<th>" . $row_4["Capex"]. "</th>" .
				 "<th>" . $row_4["nr_inv_far"]. "</th>".
				 "<th>" . $row_4["observatii"]. "</th>".
				 "<th>" . $row_4["Pret"]. "</th></tr>" ;
				 continue;
			 }
				while($row_5 = $result_q5->fetch_assoc()){
					echo "<tr>
					 <th>" . $row_5["SerialNumber"]."</th>". 
					 "<th>" . $row_5["Descriere"]. "</th>".
					 "<th>" . $row_5["Location"]. "</th>".
					 "<th>" . $row_5["amg"]. "</th>".
					 "<th>" . $row_5["Status"]. "</th>".
					 "<th>" . $row_5["Capex"]. "</th>" .
					 "<th>" . $row_5["nr_inv_far"]. "</th>" .
					 "<th>" . $row_5["observatii"]. "</th>".
					 "<th>" . $row_5["Pret"]. "</th></tr>" ;
					 continue;
				}
				while($row_6 = $result_q6->fetch_assoc()){
					echo "<tr>
					 <th>" . $row_6["SerialNumber"]."</th>". 
					 "<th>" . $row_6["Descriere"]. "</th>".
					 "<th>" . $row_6["Location"]. "</th>".
					 "<th>" . $row_6["amg"]. "</th>".
					 "<th>" . $row_6["Status"]. "</th>".
					 "<th>" . $row_6["Capex"]. "</th>" .
					 "<th>" . $row_6["nr_inv_far"]. "</th>" .
					 "<th>" . $row_6["observatii"]. "</th>".
					 "<th>" . $row_6["Pret"]. "</th></tr>" ;
					 continue;
				}
				while($row_7 = $result_q7->fetch_assoc()){
					echo "<tr> 
					 <th>" . $row_7["SerialNumber"]."</th>". 
					 "<th>" . $row_7["Descriere"]. "</th>".
					 "<th>" . $row_7["Location"]. "</th>".
					 "<th>" . $row_7["amg"]. "</th>".
					 "<th>" . $row_7["Status"]. "</th>".
					 "<th>" . $row_7["Capex"]. "</th>".
					 "<th>" . $row_7["nr_inv_far"]. "</th>" .
					 "<th>" . $row_7["observatii"]. "</th>".
					 "<th>" . $row_7["Pret"]. "</th></tr>" ;
					 continue;
				}
				while($row_8 = $result_q8->fetch_assoc()){
					echo "<tr> 
					 <th>" . $row_8["SerialNumber"]."</th>". 
					 "<th>" . $row_8["Descriere"]. "</th>".
					 "<th>" . $row_8["Location"]. "</th>".
					 "<th>" . $row_8["amg"]. "</th>".
					 "<th>" . $row_8["Status"]. "</th>".
					 "<th>" . $row_8["Capex"]. "</th>".
					 "<th>" . $row_8["nr_inv_far"]. "</th>" .
					 "<th>" . $row_8["observatii"]. "</th>".
					 "<th>" . $row_8["Pret"]. "</th></tr>" ;
					 continue;
				}
				while($row_9 = $result_q9->fetch_assoc()){
					echo "<tr> 
					 <th>" . $row_9["SerialNumber"]."</th>". 
					 "<th>" . $row_9["Descriere"]. "</th>".
					 "<th>" . $row_9["Location"]. "</th>".
					 "<th>" . $row_9["amg"]. "</th>".
					 "<th>" . $row_9["Status"]. "</th>".
					 "<th>" . $row_9["Capex"]. "</th>".
					 "<th>" . $row_9["nr_inv_far"]. "</th>" .
					 "<th>" . $row_9["observatii"]. "</th>".
					 "<th>" . $row_9["Pret"]. "</th></tr>" ;
					 //continue;
				}
}

$conn->close();
?>
</div>
</body>
</html>