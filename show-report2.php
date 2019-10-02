<?php include 'dbconnect.php'; 
	session_start();
	error_reporting(~E_NOTICE);
	if($_SESSION["user"] == "")
	{
		echo "Please Login";
		exit();
	}
	
	if($_SESSION["permission"] != "1" && $_SESSION["permission"] != "2")
	{
		echo "Please Login";
		exit();
	}
?>
<!doctype html>
<html lang="en">

<!-- Head -->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" media="screen" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
	
	<!-- Print CSS -->
	<link href="print.css" rel="stylesheet" media="print" />
	
	<!-- Style sheet -->
	<link href="stylesheet.css" rel="stylesheet"/>
		
	<!-- Style CSS -->
	<style>

	</style>
	
    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</title>
	
  <!-- Copyright 2000, 2001, 2002, 2003 Macromedia, Inc. All rights reserved. -->
  </head>
  
<!-- Body -->  
  <body>	
	<?php if((isset($_POST['yearSelect']) && isset($_POST['monthSelect']))||(isset($_GET['year']) && isset($_GET['m']))){ 
		if(isset($_POST['yearSelect']) && isset($_POST['monthSelect'])){
			$yearSelect = $_POST["yearSelect"];	
			$monthSelect = $_POST["monthSelect"];	
		}else{
			$yearSelect = $_GET["year"];	
			$monthSelect = $_GET["m"];
	?>	
		<button class="btn btn-light float-right hidden" style="border:1px solid gray; margin-right:50px; margin-top:10px;" onclick="print()">พิมพ์</button>
	<?php }			
		$sql_month = "SELECT name FROM month_db WHERE id='$monthSelect'";
		$query_month = mysqli_query($conn,$sql_month);
		$data_month = mysqli_fetch_array($query_month);
	?>
		<div class="container">
			<h5>ปีงบประมาณ <?php echo $yearSelect; ?> ประจำเดือน <?php echo $data_month['name']; ?></h5>
		</div>
		<div class="d-flex p-0">			
			<div class="container col-4 table-responsive p-1">
				<div class="d-flex justify-content-between">
					<h6>รอบปีที่ 1</h6>
					<?php if($_SESSION["permission"] == "1"){ ?>
						<a class="btn btn-sm btn-light" style="border:1px solid gray;" href="edit-report2.php?y=<?php echo $yearSelect; ?>&m=<?php echo $monthSelect; ?>&r=1" target="_blank">แก้ไข</a>
					<?php } ?>
				</div>
				<table class="table table-bordered table-sm" style="background-color:white;">
					<thead>
						<tr class="table-secondary">
							<th scope="col">ฐานความผิด</th>
							<th scope="col">จำนวนเด็ก<br/>และเยาวชนถูกจับซ้ำ</th>
							<th scope="col">คิดเป็นร้อยละ</th>
						</tr>
					</thead>
					<tbody>
						<?php 	
							$sql_detail = "SELECT * FROM report2 WHERE date_year='$yearSelect' AND date_month='$monthSelect' AND round='1' ORDER BY offence ASC";
							$query_detail = mysqli_query($conn, $sql_detail);

							while ($data_detail = mysqli_fetch_array($query_detail)){ 
								$sql_offence = "SELECT name FROM offence WHERE id=".$data_detail['offence']."";
								$query_offence = mysqli_query($conn,$sql_offence);
								$data_offence = mysqli_fetch_array($query_offence);
						?>						
							<tr>
								<td><?php echo $data_offence['name']; ?></td>
								<td><?php echo $data_detail['catchNum']; ?></td>							
								<td><?php echo $data_detail['catchPer']; ?></td>
							</tr>
						<?php }; ?>	
						<?php 
							$sql_sum = "SELECT sum(catchNum),sum(catchPer) FROM report2 WHERE date_year='$yearSelect' AND round='1'";
							$query_sum = mysqli_query($conn, $sql_sum);
							$data_sum = mysqli_fetch_array($query_sum);
						?>
						<tr class="table-secondary">
							<td>รวม</td>
							<td><?php echo $data_sum['sum(catchNum)']; ?></td>
							<td><?php echo $data_sum['sum(catchPer)']; ?></td>		
						</tr>
					</tbody>
				</table>							
			</div>		
			<!-- -->	
			<div class="container col-4 table-responsive p-1">
				<div class="d-flex justify-content-between">
					<h6>รอบปีที่ 2</h6>
					<?php if($_SESSION["permission"] == "1"){ ?>
						<a class="btn btn-sm btn-light" style="border:1px solid gray;" href="edit-report2.php?y=<?php echo $yearSelect; ?>&m=<?php echo $monthSelect; ?>&r=2" target="_blank">แก้ไข</a>
					<?php } ?>
				</div>
				<table class="table table-bordered table-sm" style="background-color:white;">
					<thead>
						<tr class="table-secondary">
							<th scope="col">ฐานความผิด</th>
							<th scope="col">จำนวนเด็ก<br/>และเยาวชนถูกจับซ้ำ</th>
							<th scope="col">คิดเป็นร้อยละ</th>
						</tr>
					</thead>
					<tbody>
						<?php 	
							$sql_detail = "SELECT * FROM report2 WHERE date_year='$yearSelect' AND date_month='$monthSelect' AND round='2' ORDER BY offence ASC";
							$query_detail = mysqli_query($conn, $sql_detail);

							while ($data_detail = mysqli_fetch_array($query_detail)){ 
								$sql_offence = "SELECT name FROM offence WHERE id=".$data_detail['offence']."";
								$query_offence = mysqli_query($conn,$sql_offence);
								$data_offence = mysqli_fetch_array($query_offence);
						?>						
							<tr>
								<td><?php echo $data_offence['name']; ?></td>
								<td><?php echo $data_detail['catchNum']; ?></td>							
								<td><?php echo $data_detail['catchPer']; ?></td>
							</tr>
						<?php }; ?>	
						<?php 
							$sql_sum = "SELECT sum(catchNum),sum(catchPer) FROM report2 WHERE date_year='$yearSelect' AND round='2'";
							$query_sum = mysqli_query($conn, $sql_sum);
							$data_sum = mysqli_fetch_array($query_sum);
						?>
						<tr class="table-secondary">
							<td>รวม</td>
							<td><?php echo $data_sum['sum(catchNum)']; ?></td>
							<td><?php echo $data_sum['sum(catchPer)']; ?></td>		
						</tr>
					</tbody>
				</table>							
			</div>		
			<!-- -->
			<div class="container col-4 table-responsive p-1">
				<div class="d-flex justify-content-between">
					<h6>รอบปีที่ 3</h6>
					<?php if($_SESSION["permission"] == "1"){ ?>
						<a class="btn btn-sm btn-light" style="border:1px solid gray;" href="edit-report2.php?y=<?php echo $yearSelect; ?>&m=<?php echo $monthSelect; ?>&r=3" target="_blank">แก้ไข</a>
					<?php } ?>
				</div>
				<table class="table table-bordered table-sm" style="background-color:white;">
					<thead>
						<tr class="table-secondary">
							<th scope="col">ฐานความผิด</th>
							<th scope="col">จำนวนเด็ก<br/>และเยาวชนถูกจับซ้ำ</th>
							<th scope="col">คิดเป็นร้อยละ</th>
						</tr>
					</thead>
					<tbody>
						<?php 	
							$sql_detail = "SELECT * FROM report2 WHERE date_year='$yearSelect' AND date_month='$monthSelect' AND round='3' ORDER BY offence ASC";
							$query_detail = mysqli_query($conn, $sql_detail);

							while ($data_detail = mysqli_fetch_array($query_detail)){ 
								$sql_offence = "SELECT name FROM offence WHERE id=".$data_detail['offence']."";
								$query_offence = mysqli_query($conn,$sql_offence);
								$data_offence = mysqli_fetch_array($query_offence);
						?>						
							<tr>
								<td><?php echo $data_offence['name']; ?></td>
								<td><?php echo $data_detail['catchNum']; ?></td>							
								<td><?php echo $data_detail['catchPer']; ?></td>
							</tr>
						<?php }; ?>	
						<?php 
							$sql_sum = "SELECT sum(catchNum),sum(catchPer) FROM report2 WHERE date_year='$yearSelect' AND round='3'";
							$query_sum = mysqli_query($conn, $sql_sum);
							$data_sum = mysqli_fetch_array($query_sum);
						?>
						<tr class="table-secondary">
							<td>รวม</td>
							<td><?php echo $data_sum['sum(catchNum)']; ?></td>
							<td><?php echo $data_sum['sum(catchPer)']; ?></td>		
						</tr>
					</tbody>
				</table>							
			</div>		
			<!-- -->			
		</div>
	<?php } ?>
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