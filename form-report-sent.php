<?php 	
	require 'dbconnect.php';	
	
	/**/
	$receiver = $_POST["txtReceiver"];
	$receiver = htmlspecialchars($receiver,ENT_QUOTES); 
	$receiver = mysqli_real_escape_string($conn,$receiver);
		
	$date_year = $_POST["txtDate_year"];
	$date_year = htmlspecialchars($date_year,ENT_QUOTES); 
	$date_year = mysqli_real_escape_string($conn,$date_year);
	
	$date_month = $_POST["txtDate_month"];
	$date_month = htmlspecialchars($date_month,ENT_QUOTES); 
	$date_month = mysqli_real_escape_string($conn,$date_month);
	
	$round = $_POST["inputRound"];
	$round = htmlspecialchars($round,ENT_QUOTES); 
	$round = mysqli_real_escape_string($conn,$round);
	
	$sentNum = $_POST["txtSentnum"];
	$sentNum = htmlspecialchars($sentNum,ENT_QUOTES); 
	$sentNum = mysqli_real_escape_string($conn,$sentNum);
	
	$catchNum = $_POST["txtCatchnum"];
	$catchNum = htmlspecialchars($catchNum,ENT_QUOTES); 
	$catchNum = mysqli_real_escape_string($conn,$catchNum);
	
	$catchPer = $_POST["txtCatchper"];
	$catchPer = htmlspecialchars($catchPer,ENT_QUOTES); 
	$catchPer = mysqli_real_escape_string($conn,$catchPer);
	
	$sql = "INSERT INTO report (receiver,date_year,date_month,round,sentNum,catchNum,catchPer)
			VALUES ('$receiver','$date_year','$date_month','$round','$sentNum','$catchNum','$catchPer')";
	$query = mysqli_query($conn,$sql);
		
	if($query){	
		echo "<script type='text/javascript'>alert('Save successfully!'); javascript:window.close();</script>";//Save successfully!	
	}else{
		echo "<script type='text/javascript'>alert('Error!!');javascript:history.go(-1);</script>";//Error!!
	}
		
	mysqli_close($conn);	
?>

