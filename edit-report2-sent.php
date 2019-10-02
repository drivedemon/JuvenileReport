<?php 	
	require 'dbconnect.php';	
	
	/**/	
	for($i = 1;$i<=7;$i++){
		$catchNum = $_POST["catchNum".$i.""];
		$catchNum = htmlspecialchars($catchNum,ENT_QUOTES); 
		$catchNum = mysqli_real_escape_string($conn,$catchNum);
	
		$catchPer = $_POST["catchPer".$i.""];
		$catchPer = htmlspecialchars($catchPer,ENT_QUOTES); 
		$catchPer = mysqli_real_escape_string($conn,$catchPer);
		
		$date_year = $_POST["txtDate_year"];
		$date_year = htmlspecialchars($date_year,ENT_QUOTES); 
		$date_year = mysqli_real_escape_string($conn,$date_year);
		
		$date_month = $_POST["txtDate_month"];
		$date_month = htmlspecialchars($date_month,ENT_QUOTES); 
		$date_month = mysqli_real_escape_string($conn,$date_month);
		
		$round = $_POST["inputRound"];	
		$round = htmlspecialchars($round,ENT_QUOTES); 
		$round = mysqli_real_escape_string($conn,$round);		
		
		$sql = "UPDATE report2 SET catchNum = '$catchNum',catchPer = '$catchPer'
				WHERE offence='$i' AND date_year='$date_year' AND date_month='$date_month' AND round='$round'";
		$query = mysqli_query($conn,$sql);		
		
		if($query){	
			echo "<script type='text/javascript'>alert('Save successfully!'); javascript:window.close();</script>";//Save successfully!	
		}else{
			echo "<script type='text/javascript'>alert('Error!!');javascript:history.go(-1);</script>";//Error!!
		}
	}
	
	mysqli_close($conn);	
?>


