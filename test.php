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
	<li><a class="active" href="idbyloc.php">Balance by Loc</a></li>
	<li><a href="delete.php">Delete</a></li>
	<li><a href="export.html">Export</a></li>
</ul>

<form id="addmv" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" name="update">
<select id="option1" name="option">
  <option value="Location" name="location">Location</option>
  <option value="SerialNumber" name="serialize">Serial</option>
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
		<th id="th4">Status</th>
	</thead>
	</tr>
<?php
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

//update tables
if(isset($_POST['submit'])){
	$option = $_POST['option'];
	$location = $_POST['loc'];

	$sql_query1 = "SELECT SerialNumber FROM monitor WHERE Location ='".$location."'";
	$sql_query2 = "SELECT * FROM compimp WHERE ".$option."='".$location."'";
	$sql_query3 = "SELECT * FROM comppc WHERE ".$option."='".$location."'";
	$sql_query4 = "SELECT * FROM imprimanta WHERE ".$option."='".$location."'";
	$sql_query5 = "SELECT * FROM pc WHERE ".$option."='".$location."'";
	$sql_query6 = "SELECT * FROM scaner WHERE ".$option."='".$location."'";
	$sql_query7 = "SELECT * FROM ups WHERE ".$option."='".$location."'";	
	
	$sql_compare1 = "SELECT SerialNumber FROM monitor WHERE ".$option."='".$location."'";
	$result_q1 = $conn->query($sql_query1);
	$result_q2 = $conn->query($sql_query2);
	$result_q3 = $conn->query($sql_query3);
	$result_q4 = $conn->query($sql_query4);
	$result_q5 = $conn->query($sql_query5);
	$result_q6 = $conn->query($sql_query6);
	$result_q7 = $conn->query($sql_query7);
	$result_compare1 = $conn->query($sql_compare1);
	while($row_1 = $result_q1->fetch_assoc()){
			 echo "<tr>
			 <th>" . $row_1["SerialNumber"]."<br><input id='compare_1' type='text' name='compare_1'></th>". 
			 "<th>" . $row_1["Descriere"]. "</th>".
			 "<th>" . $row_1["Location"]. "</th>".
			 "<th>" . $row_1["Status"]. "</th></tr>" ;
			 continue;
	}
			 while($row_2 = $result_q2->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_2["SerialNumber"]."<br><input id='compare_2' type='text' name='compare_2'></th>". 
				 "<th>" . $row_2["Descriere"]. "</th>".
				 "<th>" . $row_2["Location"]. "</th>".
				 "<th>" . $row_2["Status"]. "</th></tr>" ;
				 continue;
			 }
			  while($row_3 = $result_q3->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_3["SerialNumber"]."<br><input id='compare_3' type='text' name='compare_3'></th>". 
				 "<th>" . $row_3["Descriere"]. "</th>".
				 "<th>" . $row_3["Location"]. "</th>".
				 "<th>" . $row_3["Status"]. "</th></tr>" ;
				 continue;
			 }
			 while($row_4 = $result_q4->fetch_assoc()){
				 echo "<tr>
				 <th>" . $row_4["SerialNumber"]."<br><input id='compare_4' type='text' name='compare_4'></th>". 
				 "<th>" . $row_4["Descriere"]. "</th>".
				 "<th>" . $row_4["Location"]. "</th>".
				 "<th>" . $row_4["Status"]. "</th></tr>" ;
				 continue;
			 }
				while($row_5 = $result_q5->fetch_assoc()){
					echo "<tr>
					 <th>" . $row_5["SerialNumber"]."<br><input id='compare_5' type='text' name='compare_5'></th>". 
					 "<th>" . $row_5["Descriere"]. "</th>".
					 "<th>" . $row_5["Location"]. "</th>".
					 "<th>" . $row_5["Status"]. "</th></tr>" ;
					 continue;
				}
				while($row_6 = $result_q6->fetch_assoc()){
					echo "<tr>
					 <th>" . $row_6["SerialNumber"]."<br><input id='compare_6' type='text' name='compare_6'></th>". 
					 "<th>" . $row_6["Descriere"]. "</th>".
					 "<th>" . $row_6["Location"]. "</th>".
					 "<th>" . $row_6["Status"]. "</th></tr>" ;
					 continue;
				}
				while($row_7 = $result_q7->fetch_assoc()){
					echo "<tr> 
					 <th>" . $row_7["SerialNumber"]."<br><input id='compare_7' type='text' name='compare_7'></th>". 
					 "<th>" . $row_7["Descriere"]. "</th>".
					 "<th>" . $row_7["Location"]. "</th>".
					 "<th>" . $row_7["Status"]. "</th>".
					 "<input id='sub4' type='submit' name='submit_1' value='Submit' /><br>" ;
					 continue;
				}
				while($row_8 = $result_compare1->fetch_assoc()){
					$string = join(',', $row_8);
					foreach($row_8 as $key => $value){
						$string .= ",$value";
					}
					//$string = substr($string, 1);
					echo $string;
					//print_r($row_8);
				}
}

$conn->close();
?>

</div>
</body>
</html>