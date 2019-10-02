<?php 	
	require 'dbconnect.php';	
	
	$str_del = "DELETE FROM report WHERE id = '".$_GET["id"]."' ";
	$qry_del = mysqli_query($conn,$str_del);	
		
	mysqli_close($conn);
?>

