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
	
	if($_SESSION["userID"] != "99")
	{
		echo "Please Login as Admin";
		exit();
	}

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
	
    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำในครั้งแรก(จำแนกตามฐานความผิด)</title>
	
  </head>
  
<!-- Body -->  
  <body>
	<div class="container pt-3 text-center">
		<h3><img src="hd-13.jpg" width="1000" height="150"></h3>
	</div>
	<!-- Form -->
	<div class="container p-2" style="max-width:800px;">
		<h4 class="text-center">แก้ไขรายงาน</h4>
		<form name="report" action="edit-report2-sent.php" method="post" enctype="multipart/form-data" id="report-form">	
			<!-- Text input -->
			<div class="form-group row">
				<label for="input-date_year" class="col-3 col-form-label">ปีงบประมาณ:</label>
				<div class="col-4">
					<input type="text" name="txtDate_year" readonly class="form-control-plaintext" id="input-date_year" value="<?php echo $_GET['y'] ?>" />
				</div>
				<label for="input-date_month" class="col-1 col-form-label">เดือน:</label>
				<div class="col-4">
					<?php  
						$sql_month = "SELECT name FROM month_db WHERE id=".$_GET['m']."";
						$query_month = mysqli_query($conn,$sql_month);					
						$data_month = mysqli_fetch_array($query_month);					
					?>
					<input type="text" name="txtDate_month" hidden class="form-control-plaintext" id="input-date_month" value="<?php echo $_GET['m'] ?>" /><?php echo $data_month['name'] ?>	
				</div>
			</div>
			<div class="form-group row">
				<label for="input-round" class="col-sm-3 col-form-label">รอบปีที่:</label>
				<div class="col-sm-9">
					<input type="text" name="inputRound" readonly class="form-control-plaintext" id="input-round" value="<?php echo $_GET['r'] ?>" />
				</div>
			</div>
			<div class="form-group">
				<table class="table table-light table-bordered">					
					<thead>
						<tr>
							<th scope="col" style="width:40%;">ฐานความผิด</th>
							<th scope="col">จำนวนเด็กและเยาวชนถูกจับซ้ำ</th>
							<th scope="col">คิดเป็นร้อยละ</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$sql_edit = "SELECT * FROM report2 WHERE date_year=".$_GET['y']." AND date_month=".$_GET['m']." AND round=".$_GET['r']." ORDER BY offence ASC";
							$query_edit = mysqli_query($conn,$sql_edit);					
							while($data_edit = mysqli_fetch_array($query_edit)){
						?> 
								<tr>
									<?php  
										$sql_offence = "SELECT name FROM offence WHERE id=".$data_edit['offence']."";
										$query_offence = mysqli_query($conn,$sql_offence);					
										$data_offence = mysqli_fetch_array($query_offence);					
									?>
									<td><?php echo $data_offence['name'] ?></td>
									<td><input type="number" name="catchNum<?php echo $data_edit['offence'] ?>" class="form-control form-control-sm" id="catchNum<?php echo $data_edit['offence'] ?>" placeholder="0" value="<?php echo $data_edit['catchNum'] ?>"></td>
									<td><input type="number" name="catchPer<?php echo $data_edit['offence'] ?>" class="form-control form-control-sm" id="catchPer<?php echo $data_edit['offence'] ?>" step="0.01" placeholder="00.00" value="<?php echo $data_edit['catchPer'] ?>"></td>
								</tr>
						<?php  
							}
						?> 						
					</tbody>
				</table>
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