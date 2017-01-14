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
//echo "ID";
if(isset($_POST['submit'])){
	if($_POST['option'] == 'toate'){
		
		$result = mysqli_query($conn, "SELECT * FROM monitor");
		$result_1 = mysqli_query($conn, "SELECT * FROM pc");
		$result_2 = mysqli_query($conn, "SELECT * FROM imprimanta");
		$result_3 = mysqli_query($conn, "SELECT * FROM ups");
		$result_4 = mysqli_query($conn, "SELECT * FROM scaner");
		$result_5 = mysqli_query($conn, "SELECT * FROM compimp");
		$result_7 = mysqli_query($conn, "SELECT * FROM amg_assets");
		$result_8 = mysqli_query($conn, "SELECT * FROM turn_aps");
		//$result_6 = mysqli_query($conn, "SELECT * FROM compipc");
		if (!$result) die('Couldn\'t fetch records'); 
		if (!$result_1) die('Couldn\'t fetch records');
		if (!$result_2) die('Couldn\'t fetch records');
		if (!$result_3) die('Couldn\'t fetch records');
		if (!$result_4) die('Couldn\'t fetch records');
		$num_fields = mysqli_num_fields($result); 
		$headers = array(); 
		for ($i = 0; $i < $num_fields; $i++) 
		{     
		//$headers[] = mysqli_fetch_field($result,$i); 
		} 
		$fp = fopen('php://output', 'w'); 
		if ($fp && $result) 
		{     
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename=inventar.csv');
		header('Pragma: no-cache');    
		header('Expires: 0');
		fputcsv($fp, array('id', 'Serial Number', 'Descriere', 'Locatie','AMG', 'Status', 'Capex', 'Numar Inv FAR', 'Observatii', 'Pret')); 
		while ($row = mysqli_fetch_row($result)) 
		{
		fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_1))
		{
			fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_2))
		{
			fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_3))
		{
			fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_4))
		{
			fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_5))
		{
			fputcsv($fp, array_values($row)); 
		}
		//while ($row = mysqli_fetch_row($result_6))
		//{
			//fputcsv($fp, array_values($row)); 
		//}
		while ($row = mysqli_fetch_row($result_7))
		{
			fputcsv($fp, array_values($row)); 
		}
		while ($row = mysqli_fetch_row($result_8))
		{
			fputcsv($fp, array_values($row)); 
		}
		die; 
		}
		
	}else{
		
		$result = mysqli_query($conn, "SELECT * FROM ".$_POST['option'].""); 
		if (!$result) die('Couldn\'t fetch records'); 
		$num_fields = mysqli_num_fields($result); 
		$headers = array(); 
		for ($i = 0; $i < $num_fields; $i++) 
		{     
		//$headers[] = mysqli_fetch_field($result,$i); 
		} 
		$fp = fopen('php://output', 'w'); 
		if ($fp && $result) 
		{     
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename='.$_POST['option'].'.csv');
		header('Pragma: no-cache');    
		header('Expires: 0');
		fputcsv($fp, array('id', 'Serial Number', 'Descriere', 'Locatie','AMG', 'Status', 'Capex', 'Numar Inv FAR','Observatii', 'Pret')); 
		while ($row = mysqli_fetch_row($result)) 
		{
		fputcsv($fp, array_values($row)); 
		}
		die; 
		}
		}
}
?>