<?php
	require_once 'password.php';
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	require 'dbconnect.php';
	$username = $_POST["txtUser"];
	$username = htmlspecialchars($username,ENT_QUOTES);
	$username = mysqli_real_escape_string($conn,$username);
	$password = $_POST["txtPass"];
	$password = htmlspecialchars($password,ENT_QUOTES);
	$password = mysqli_real_escape_string($conn,$password);
	/**/
	$sql_checkpass = "select * from user where username = '$username'";
	$query_checkpass = mysqli_query($conn,$sql_checkpass);
	$numRows = mysqli_num_rows($query_checkpass);
	
	if($numRows  == 1){
		$row = mysqli_fetch_assoc($query_checkpass);
		$password_en = password_verify($password,$row['password']);
		// if(password_verify($password,$row['password'])){
			$sql = "SELECT * FROM user WHERE username='$username'";
			$query = mysqli_query($conn,$sql);
			$data = mysqli_fetch_array($query);

			$_SESSION["user"] = $data["username"];
			$_SESSION["permission"] = $data["permission_group"];
			$_SESSION["userID"] = $data["id"];
			session_write_close();

			/**/
			if($data['permission_group']=='1'){
				Header("Location: page-admin.php");
			}else{
				Header("Location: page-user.php?user=".$data['id']."");
			}
		// }
		// else{
		// 	echo "Wrong Password";
		// }
	}
	else{
		echo "No User found";
	}

	mysqli_close($conn);
?>
