<?php 	
	require 'dbconnect.php';	
	require_once 'passwordLib.php';
	/**/
	$name = $_POST["txtName"];
	$group = $_POST["txtGroup"];
	$user = $_POST["txtUser"];
	$password = $_POST["txtPass"];
		
	$options = array("cost"=>4);
		$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
		
		$sql = "insert into user (name, permission_group,username, password) value('$name', '$group', '$user','$hashPassword')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			echo "Registration successfully";
			echo "<br/><div><a href='register.php'>ย้อนกลับ</a>";
		}
		
	mysqli_close($conn);	
?>

