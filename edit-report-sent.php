<?php 	
	require 'dbconnect.php';	
	
	/**/
	$sentNum = $_POST["txtSentnum"];
	$sentNum = htmlspecialchars($sentNum,ENT_QUOTES); 
	$sentNum = mysqli_real_escape_string($conn,$sentNum);
		
	$catchNum = $_POST["txtCatchnum"];
	$catchNum = htmlspecialchars($catchNum,ENT_QUOTES); 
	$catchNum = mysqli_real_escape_string($conn,$catchNum);
		
	$catchPer = $_POST["txtCatchper"];
	$catchPer = htmlspecialchars($catchPer,ENT_QUOTES); 
	$catchPer = mysqli_real_escape_string($conn,$catchPer);
	
	$sql = "UPDATE report SET sentNum = '$sentNum',catchNum = '$catchNum',catchPer = '$catchPer' WHERE id=".$_GET['id']."";
	$query = mysqli_query($conn,$sql);
		
	if($query){	
		echo "<script type='text/javascript'>alert('Save successfully!'); javascript:window.close();</script>";//Save successfully!	
	}else{
		echo "<script type='text/javascript'>alert('Error!!');javascript:history.go(-1);</script>";//Error!!
	}
		
	mysqli_close($conn);	
?>

