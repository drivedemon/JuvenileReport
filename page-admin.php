<?php
	session_start();
	error_reporting(~E_NOTICE);
	if($_SESSION["user"] == "")
	{
		echo "Please Login";
		exit();
	}

	if($_SESSION["permission"] != "1")
	{
		echo "Please Login as Admin";
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
	<!-- Bootstrap 4 for IE8 and IE9 -->
	<meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
	<!-- Style sheet -->
	<link href="stylesheet.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
    <title>[หน้าแรก]</title>
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
					<a href="form-report.php" target="_blank" class="list-group-item list-group-item-action">ส่งรายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</a>
			</ul>
			&nbsp;
			<ul class="list-group">
					<a href="detail-report.php" target="_blank" class="list-group-item list-group-item-action">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามปีงบประมาณ)</a>
			</ul>
			&nbsp;
			<ul class="list-group">
					<a href="detail-report3.php" target="_blank" class="list-group-item list-group-item-action">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามศูนย์ฝึกฯ)</a>
			</ul>
		</div>
		<hr>
		<div class="row">
			<ul class="list-group">
					<a href="form_upload.php" target="_blank" class="list-group-item list-group-item-action">ส่งรายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ (Excel)</a>
			</ul>
		</div>
		<hr>
		<div class="row">
			<ul class="list-group">
					<a href="detail-report.php" target="_blank" class="list-group-item list-group-item-action">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามปีงบประมาณ)</a>
			</ul>
		</div>


		<!-- <a href="form-report.php" target="_blank">ส่งรายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</a><br />
		<a href="detail-report.php" target="_blank">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามปีงบประมาณ)</a><br />
		<a href="detail-report3.php" target="_blank">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามศูนย์ฝึกฯ)</a><br />
		<a href="form-report2.php" target="_blank">ส่งรายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำในครั้งแรก(จำแนกตามฐานความผิด)</a><br />
		<a href="detail-report2.php" target="_blank">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำในครั้งแรก(จำแนกตามฐานความผิด)</a><br /> -->

	</div>
	<footer>
		<div class="footer footer-copyright text-center py-3">
			<a href="logout.php" class="btn btn-secondary">Logout</a>
		</div>
	</footer>

	<!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<!-- JScript -->
	<script>

	</script>
  </body>
</html>
