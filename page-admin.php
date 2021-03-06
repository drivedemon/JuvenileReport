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
				<button type="button" style="cursor:pointer;" class="list-group-item list-group-item-action" onclick="newTab('0')">ส่งรายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ (Excel)</button>
			</ul>
			&emsp;
			<ul class="list-group">
			<button type="button" style="cursor:pointer;" data-toggle="modal" data-target="#typeModal" class="list-group-item list-group-item-action">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามปีงบประมาณ)</button>
		</ul>
	</div>
	<!-- <div class="row">
		<label for=""></label>
	</div>
	<div class="row">
		<ul class="list-group">
			<button type="button" style="cursor:pointer;" data-toggle="modal" data-target="#typeModal" class="list-group-item list-group-item-action">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ(ตามปีงบประมาณ)</button>
		</ul>
	</div> -->

	<!-- Modal -->
	<div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="typeModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<button type="button" class="btn btn-info" onclick="newTab('1')">สถานพินิจฯ</button>
					<button type="button" class="btn btn-success" onclick="newTab('2')">ศูนย์ฝึกฯ</button>
				</div>
			</div>
		</div>
	</div>
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
function newTab(t){
	if (t == 0) {
		link = "form_upload.php";
	} else {
		link = "detail-report.php?t="+t;
	}
	window.open(link,'_blank');
}
</script>
</body>
</html>
