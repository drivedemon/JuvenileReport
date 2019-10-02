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

	// if($_SESSION["userID"] != "99")
	// {
	// 	echo "Please Login as Admin";
	// 	exit();
	// }

	include 'dbconnect.php';
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

	<!-- Bootstrap 4 for IE8 and IE9  -->
		 <!--[if IE 9]>
		  <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
		<![endif]-->
		<!--[if lte IE 8]>
		  <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
		  <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
		<![endif]-->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">

	<!-- Style sheet -->
	<link href="stylesheet.css" rel="stylesheet"/>

	<!-- Style CSS -->
	<style>

	</style>

    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</title>

  </head>

<!-- Body -->
  <body>
	<div class="container pt-3 text-center">
		<h3><img src="hd-13.jpg" width="1000" height="150"></h3>
	</div>
	<!-- Form -->
	<div class="container p-2" style="max-width:800px;">
		<div class="container p-2 text-right">
			<a href="detail-report.php?p=1" target="_blank">ดูรายงานทั้งหมด</a>
		</div>
		<form name="report" action="form-report-sent.php" method="post" enctype="multipart/form-data" id="report-form">
			<!-- Text input -->
			<div class="form-group row">
				<label for="input-receiver" class="col-sm-3 col-form-label">ถึงหน่วยงาน:</label>
				<div class="col-sm-9">
					<select class="form-control" name="txtReceiver" id="input-receiver">
						<?php
							$sql_receiver = "SELECT id,name FROM user WHERE permission_group='2' ORDER BY id ASC";
							$query_receiver = mysqli_query($conn,$sql_receiver);
						?>
						<?php while ($data_receiver = mysqli_fetch_array($query_receiver)){ ?>
							<option value="<?php echo $data_receiver['id']; ?>">
								<?php echo $data_receiver['name']; ?>
							</option>
						<?php }; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-creator" class="col-sm-3 col-form-label">ผู้รายงาน:</label>
				<div class="col-sm-9">
					<input type="text" name="txtCreator" readonly class="form-control-plaintext" id="input-creator" value="กลุ่มศาสตร์พระราชา"/>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-date_year" class="col-3 col-form-label">ปีงบประมาณ:</label>
				<div class="col-4">
						<select class="form-control" name="txtDate_year" id="input-date_year">
						<?php $current = date("Y")+543;
							for($y=2558;$y<=$current+1;$y++){ ?>
								<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
						<?php } ?>
					</select>
				</div>
				<label for="input-date_month" class="col-1 col-form-label">เดือน:</label>
				<div class="col-4">
					<select class="form-control" name="txtDate_month" id="input-date_month">
						<?php $month=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
							for($i=0;$i<count($month);$i++){ ?>
								<option value="<?php echo $i+1; ?>"><?php echo $month[$i]; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-round" class="col-sm-3 col-form-label">รอบปีที่:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputRound" id="round1" value="1" required />
					  <label class="form-check-label" for="round1">1</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputRound" id="round2" value="2" required />
					  <label class="form-check-label" for="round2">2</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputRound" id="round3" value="3" required />
					  <label class="form-check-label" for="round3">3</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-sentnum" class="col-sm-3 col-form-label">จำนวนที่ส่งตรวจสอบ(คน):</label>
				<div class="col-sm-9">
					<input type="number" name="txtSentnum" class="form-control" id="input-sentnum" required />
				</div>
			</div>
			<div class="form-group row">
				<label for="input-catchnum" class="col-sm-3 col-form-label">จำนวนเด็ก/เยาวชน<br/>ที่ถูกจับซ้ำ(คน):</label>
				<div class="col-sm-9">
					<input type="number" name="txtCatchnum" class="form-control" id="input-catchnum" required />
				</div>
			</div>
			<div class="form-group row">
				<label for="input-catchper" class="col-sm-3 col-form-label">ร้อยละของเด็ก/เยาวชน<br/>ที่ถูกจับซ้ำ(%):</label>
				<div class="col-sm-9">
					<input type="number" name="txtCatchper" class="form-control" id="input-catchper" step="0.01"required />
				</div>
			</div>
			<!-- /Text input -->
			<div class="form-group text-right">
				<div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
		<div class="text-center">
			<a href="javascript:window.close()">ปิดหน้าต่าง</a> |
			<a href="logout.php">Logout</a>
		</div>
	</div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<!-- JScript -->
	<script>

	</script>
  </body>
	<!--The MIT License (MIT)-->

	<!--
	Copyright (c) 2011-2016 Twitter, Inc.
	Copyright JS Foundation and other contributors, https://js.foundation/

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.

	-------------------------------------------
	Copyright JS Foundation and other contributors, https://js.foundation/

	Permission is hereby granted, free of charge, to any person obtaining
	a copy of this software and associated documentation files (the
	"Software"), to deal in the Software without restriction, including
	without limitation the rights to use, copy, modify, merge, publish,
	distribute, sublicense, and/or sell copies of the Software, and to
	permit persons to whom the Software is furnished to do so, subject to
	the following conditions:

	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	-->
</html>
