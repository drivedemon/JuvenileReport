<?php
	session_start();
	error_reporting(~E_NOTICE);
	if($_SESSION["user"] == "")	{
		echo "กรุณาลงชื่อเข้าใช้";
		exit();
	}
	if($_SESSION["permission"] != "2") {
		echo "ไม่อนุญาตให้เข้าใช้";
		exit();
	}
	if($_SESSION["userID"] != $_GET['user']) {
		echo "ข้อมูลผู้ใช้ไม่ถูกต้อง";
		exit();
	}
	require 'dbconnect.php';
?>
<!doctype html>
<html lang="en">
<!-- Head -->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
	<!-- Style sheet -->
	<link href="stylesheet.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
	<!-- Style CSS -->
	<style>
	</style>
    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</title>
  </head>
<!-- Body -->
  <body>
	<div class="container pt-3 text-center">
		<h3><img class="img-fluid" src="hd-13.jpg"></h3>
		<h3>[หน้าแรก]รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</h3>
	</div>
	<div class="container p-2">
		<div class="row">
			<ul class="list-group">
				<button type="button" style="cursor:pointer;" class="list-group-item list-group-item-action" onclick="newTab('<?=$_GET['user']?>')">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ (ตามปีงบประมาณ)</button>
			</ul>
	</div>
		<footer>
			<div class="footer footer-copyright text-center py-3">
				<a href="logout.php" class="btn btn-secondary">Logout</a>
			</div>
		</footer>
	</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script>
	function newTab(t){
		link = "report-user.php?user="+t;
		window.open(link,'_blank');
	}
	</script>
  </body>
</html>
