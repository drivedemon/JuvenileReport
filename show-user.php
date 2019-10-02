<?php include 'dbconnect.php';
	error_reporting(~E_NOTICE);
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

  </head>

<!-- Body -->
  <body>
	<?php if(isset($_POST['yearSelect']) || isset($_GET['year'])){
		if(isset($_POST['yearSelect'])){
			$yearSelect = $_POST["yearSelect"];
		}else{
			$yearSelect = $_GET["year"]; ?>
			<button class="btn btn-light float-right hidden" style="border:1px solid gray; margin-right:50px; margin-top:10px;" onclick="print()">พิมพ์</button>
	<?php }
	?>
	<div class="d-flex d-flex-inline p-0">
		<div class="container col-4 table-responsive p-1">
			<table class="table table-bordered table-sm" style="background-color:white;">
				<h6>รอบปีที่ 1</h6>
				<thead>
					<tr class="table-secondary">
						<th scope="col" style="width:20%;"></th>
						<th scope="col">ประจำเดือน</th>
						<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
						<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
						<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_detail = "SELECT * FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='1' ORDER BY date_record AND date_month DESC";
						$query_detail = mysqli_query($conn, $sql_detail);
						echo "$sql_detail";
						while ($data_detail = mysqli_fetch_array($query_detail)){
							$sql_month = "SELECT name FROM month_db WHERE id=".$data_detail['date_month']."";
							$query_month = mysqli_query($conn,$sql_month);
							$data_month = mysqli_fetch_array($query_month);
					?>
						<tr>
							<td></td>
							<td><?php echo $data_month['name']; ?></td>
							<td><?php echo $data_detail['sentNum']; ?></td>
							<td><?php echo $data_detail['catchNum']; ?></td>
							<td><?php echo $data_detail['catchPer']; ?></td>
						</tr>
					<?php }; ?>
					<?php
						$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='1'";
						$query_sumthis = mysqli_query($conn, $sql_sumthis);
						$data_sumthis = mysqli_fetch_array($query_sumthis);
						if(isset($data_sumthis['sum(sentNum)'])){
							$percentagethis = number_format($data_sumthis['sum(catchNum)']/$data_sumthis['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentagethis = " ";
						}
					?>
					<tr class="table-secondary">
						<td>รวม</td>
						<td></td>
						<td><?php echo $data_sumthis['sum(sentNum)']; ?></td>
						<td><?php echo $data_sumthis['sum(catchNum)']; ?></td>
						<td><?php echo $percentagethis; ?></td>
					</tr>
					<?php
						$sql_sum = "SELECT sum(sentNum),sum(catchNum),max(catchPer),min(catchPer) FROM report WHERE date_year='$yearSelect' AND round='1'";
						$query_sum = mysqli_query($conn, $sql_sum);
						$data_sum = mysqli_fetch_array($query_sum);
						if(isset($data_sum['sum(sentNum)'])){
							$percentage = number_format($data_sum['sum(catchNum)']/$data_sum['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentage = " ";
						}						?>
					<tr class="table-secondary">
						<td>รวม<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td><?php echo $data_sum['sum(sentNum)']; ?></td>
						<td><?php echo $data_sum['sum(catchNum)']; ?></td>
						<td><?php echo $percentage; ?></td>
					</tr>
					<tr class="table-secondary">
						<td>Max / Min<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="container col-4 table-responsive p-1">
			<table class="table table-bordered table-sm" style="background-color:white;">
				<h6>รอบปีที่ 2</h6>
				<thead>
					<tr class="table-secondary">
						<th scope="col" style="width:20%;"></th>
						<th scope="col">ประจำเดือน</th>
						<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
						<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
						<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_detail = "SELECT * FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='2' ORDER BY date_record AND date_month DESC";
						$query_detail = mysqli_query($conn, $sql_detail);
						while ($data_detail = mysqli_fetch_array($query_detail)){
							$sql_month = "SELECT name FROM month_db WHERE id=".$data_detail['date_month']."";
							$query_month = mysqli_query($conn,$sql_month);
							$data_month = mysqli_fetch_array($query_month);
					?>
						<tr>
							<td></td>
							<td><?php echo $data_month['name']; ?></td>
							<td><?php echo $data_detail['sentNum']; ?></td>
							<td><?php echo $data_detail['catchNum']; ?></td>
							<td><?php echo $data_detail['catchPer']; ?></td>
						</tr>
					<?php }; ?>
					<?php
						$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='2'";
						$query_sumthis = mysqli_query($conn, $sql_sumthis);
						$data_sumthis = mysqli_fetch_array($query_sumthis);
						if(isset($data_sumthis['sum(sentNum)'])){
							$percentagethis = number_format($data_sumthis['sum(catchNum)']/$data_sumthis['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentagethis = " ";
						}
					?>
					<tr class="table-secondary">
						<td>รวม</td>
						<td></td>
						<td><?php echo $data_sumthis['sum(sentNum)']; ?></td>
						<td><?php echo $data_sumthis['sum(catchNum)']; ?></td>
						<td><?php echo $percentagethis; ?></td>
					</tr>
					<?php
						$sql_sum = "SELECT sum(sentNum),sum(catchNum),max(catchPer),min(catchPer) FROM report WHERE date_year='$yearSelect' AND round='2'";
						$query_sum = mysqli_query($conn, $sql_sum);
						$data_sum = mysqli_fetch_array($query_sum);
						if(isset($data_sum['sum(sentNum)'])){
							$percentage = number_format($data_sum['sum(catchNum)']/$data_sum['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentage = " ";
						}						?>
					<tr class="table-secondary">
						<td>รวม<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td><?php echo $data_sum['sum(sentNum)']; ?></td>
						<td><?php echo $data_sum['sum(catchNum)']; ?></td>
						<td><?php echo $percentage; ?></td>
					</tr>
					<tr class="table-secondary">
						<td>Max / Min<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="container col-4 table-responsive p-1">
			<table class="table table-bordered table-sm" style="background-color:white;">
				<h6>รอบปีที่ 3</h6>
				<thead>
					<tr class="table-secondary">
						<th scope="col" style="width:20%;"></th>
						<th scope="col">ประจำเดือน</th>
						<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
						<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
						<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_detail = "SELECT * FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='3' ORDER BY date_record AND date_month DESC";
						$query_detail = mysqli_query($conn, $sql_detail);
						while ($data_detail = mysqli_fetch_array($query_detail)){
							$sql_month = "SELECT name FROM month_db WHERE id=".$data_detail['date_month']."";
							$query_month = mysqli_query($conn,$sql_month);
							$data_month = mysqli_fetch_array($query_month);
					?>
						<tr>
							<td></td>
							<td><?php echo $data_month['name']; ?></td>
							<td><?php echo $data_detail['sentNum']; ?></td>
							<td><?php echo $data_detail['catchNum']; ?></td>
							<td><?php echo $data_detail['catchPer']; ?></td>
						</tr>
					<?php }; ?>
					<?php
						$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver=".$_GET['user']." AND date_year='$yearSelect' AND round='3'";
						$query_sumthis = mysqli_query($conn, $sql_sumthis);
						$data_sumthis = mysqli_fetch_array($query_sumthis);
						if(isset($data_sumthis['sum(sentNum)'])){
							$percentagethis = number_format($data_sumthis['sum(catchNum)']/$data_sumthis['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentagethis = " ";
						}
					?>
					<tr class="table-secondary">
						<td>รวม</td>
						<td></td>
						<td><?php echo $data_sumthis['sum(sentNum)']; ?></td>
						<td><?php echo $data_sumthis['sum(catchNum)']; ?></td>
						<td><?php echo $percentagethis; ?></td>
					</tr>
					<?php
						$sql_sum = "SELECT sum(sentNum),sum(catchNum),max(catchPer),min(catchPer) FROM report WHERE date_year='$yearSelect' AND round='3'";
						$query_sum = mysqli_query($conn, $sql_sum);
						$data_sum = mysqli_fetch_array($query_sum);
						if(isset($data_sum['sum(sentNum)'])){
							$percentage = number_format($data_sum['sum(catchNum)']/$data_sum['sum(sentNum)']*100, 2, '.', ',');
						}else{
							$percentage = " ";
						}						?>
					<tr class="table-secondary">
						<td>รวม<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td><?php echo $data_sum['sum(sentNum)']; ?></td>
						<td><?php echo $data_sum['sum(catchNum)']; ?></td>
						<td><?php echo $percentage; ?></td>
					</tr>
					<tr class="table-secondary">
						<td>Max / Min<br/>(ทั้งประเทศ)</td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
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
