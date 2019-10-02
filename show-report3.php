<?php include 'dbconnect.php'; 
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
		/*Hidden Content*/
		.hiddenContent {
			display: none;
		}	
		/*Show First Picture on page*/
		#table0{
			display:block;
		}
	</style>
	
    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</title>
	
  </head>
  
<!-- Body -->  
  <body>	
	<?php if((isset($_POST['selectReceiver']) && isset($_POST['yearSelect']))||(isset($_GET['year']) && isset($_GET['to']))){ 
		if(isset($_POST['selectReceiver']) && isset($_POST['yearSelect'])){
			$yearSelect = $_POST["yearSelect"];	
			$recieverSelect = $_POST["selectReceiver"];	
		}else{
			$yearSelect = $_GET['year'];	
			$recieverSelect = $_GET['to'];
	?>	
			<button class="btn btn-light float-right hidden" style="border:1px solid gray; margin-right:50px; margin-top:10px;" onclick="print()">พิมพ์</button>
	<?php }		
		$sql_receiver = "SELECT name FROM user WHERE id='$recieverSelect'";
		$query_receiver = mysqli_query($conn,$sql_receiver);
		$data_receiver = mysqli_fetch_array($query_receiver);
	?>
	<div class="container">
		<h5>ปีงบประมาณ <?php echo $yearSelect; ?> <?php echo $data_receiver['name']; ?></h5>
	</div>
	<div class="container d-inline-flex">
		<div class="col-3 hidden" style="border-right:1px solid gray;">	
			<a class="btn btn-sm w-100 border" href="javascript:void(0);" onclick='show(0,3);'>
				รอบปีที่ 1
			</a>
			<br />
			<a class="btn btn-sm w-100 border" href="javascript:void(0);" onclick='show(1,3);'>
				รอบปีที่ 2
			</a>
			<br />
			<a class="btn btn-sm w-100 border" href="javascript:void(0);" onclick='show(2,3);'>
				รอบปีที่ 3
			</a>
			<br />				
			<br/>					
		</div>
		<div class="col-9">
			<div class="hiddenContent" id="table0">
				<!-- ตาราง 1 -->
				<div class="container table-responsive p-1">
					<h6>รอบปีที่ 1</h6>
					<table class="table table-bordered table-sm" style="background-color:white;">
						<thead>
							<tr class="table-secondary text-center">
								<th scope="col"></th>
								<th scope="col">ประจำเดือน</th>
								<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
								<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
								<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
								<th class="hidden" scope="col">แก้ไข</th>
								<th class="hidden" scope="col">ลบออก</th>
							</tr>
						</thead>
						<tbody>	
							<?php 
								$sql_detail = "SELECT * FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='1' ORDER BY date_record AND date_month DESC";
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
									<td class="text-center hidden"><a href="edit-report.php?id=<?php echo $data_detail['id'] ?>" target="_blank">แก้ไข</a></td>
									<td class="text-center hidden"><a href="#" onclick="DeleteRecord(<?php echo $data_detail['id'] ?>)">ลบ</a></td>										
								</tr>
							<?php }; ?>
							<?php 
								$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='1'";
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
								<td class="hidden"></td>
								<td class="hidden"></td>
							</tr>							
							<?php 
								$sql_sum = "SELECT sum(sentNum),sum(catchNum),max(catchPer),min(catchPer) FROM report WHERE date_year='$yearSelect' AND round='1'";
								$query_sum = mysqli_query($conn, $sql_sum);
								$data_sum = mysqli_fetch_array($query_sum);
								if(isset($data_sum['sum(sentNum)'])){
									$percentage = number_format($data_sum['sum(catchNum)']/$data_sum['sum(sentNum)']*100, 2, '.', ',');
								}else{
									$percentage = " ";
								}
							?>
							<tr class="table-secondary">
								<td>รวม<br/>(ทั้งประเทศ)</td>
								<td></td>
								<td><?php echo $data_sum['sum(sentNum)']; ?></td>
								<td><?php echo $data_sum['sum(catchNum)']; ?></td>							
								<td><?php echo $percentage; ?></td>
								<td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
							<tr class="table-secondary">
								<td>Max / Min<br/>(ทั้งประเทศ)</td>
								<td></td>
								<td></td>
								<td></td>							
								<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?><td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<div class="hiddenContent" id="table1">
				<!-- ตาราง 2 -->
				<div class="container table-responsive p-1">
					<h6>รอบปีที่ 2</h6>
					<table class="table table-bordered table-sm" style="background-color:white;">
						<thead>
							<tr class="table-secondary text-center">
								<th scope="col"></th>
								<th scope="col">ประจำเดือน</th>
								<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
								<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
								<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
								<th class="hidden" scope="col">แก้ไข</th>
								<th class="hidden" scope="col">ลบออก</th>
							</tr>
						</thead>
						<tbody>	
							<?php 
								$sql_detail = "SELECT * FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='2' ORDER BY date_record AND date_month DESC";
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
									<td class="text-center hidden"><a href="edit-report.php?id=<?php echo $data_detail['id'] ?>" target="_blank">แก้ไข</a></td>
									<td class="text-center hidden"><a href="#" onclick="DeleteRecord(<?php echo $data_detail['id'] ?>)">ลบ</a></td>										
								</tr>
							<?php }; ?>
							<?php 
								$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='2'";
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
								<td class="hidden"></td>
								<td class="hidden"></td>
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
								<td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
							<tr class="table-secondary">
								<td>Max / Min<br/>(ทั้งประเทศ)</td>
								<td></td>
								<td></td>
								<td></td>							
								<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?><td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<div class="hiddenContent" id="table2">
				<!-- ตาราง 3 -->
				<div class="container table-responsive p-1">
					<h6>รอบปีที่ 3</h6>
					<table class="table table-bordered table-sm" style="background-color:white;">
						<thead>
							<tr class="table-secondary text-center">
								<th scope="col"></th>
								<th scope="col">ประจำเดือน</th>
								<th scope="col">จำนวนที่ส่งตรวจสอบ(คน)</th>
								<th scope="col">จำนวนเด็ก/เยาวชนที่ถูกจับซ้ำ(คน)</th>
								<th scope="col">ร้อยละของเด็ก/เยาวชนที่ถูกจับซ้ำ</th>
								<th class="hidden" scope="col">แก้ไข</th>
								<th class="hidden" scope="col">ลบออก</th>
							</tr>
						</thead>
						<tbody>	
							<?php 							
								$sql_detail = "SELECT * FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='3' ORDER BY date_record AND date_month DESC";
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
									<td class="text-center hidden"><a href="edit-report.php?id=<?php echo $data_detail['id'] ?>" target="_blank">แก้ไข</a></td>
									<td class="text-center hidden"><a href="#" onclick="DeleteRecord(<?php echo $data_detail['id'] ?>)">ลบ</a></td>										
								</tr>
							<?php }; ?>
							<?php 
								$sql_sumthis = "SELECT sum(sentNum),sum(catchNum) FROM report WHERE receiver='$recieverSelect' AND date_year='$yearSelect' AND round='3'";
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
								<td class="hidden"></td>
								<td class="hidden"></td>
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
								<td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
							<tr class="table-secondary">
								<td>Max / Min<br/>(ทั้งประเทศ)</td>
								<td></td>
								<td></td>
								<td></td>							
								<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?><td class="hidden"></td>
								<td class="hidden"></td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
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
		function show(nr,num_rows_tr) {
			for(i=0;i<num_rows_tr;i++){
				if(i==nr){
					document.getElementById("table"+nr).style.display="block";
				}else{
					document.getElementById("table"+i).style.display="none";
				}
			}
		}
		
		function DeleteRecord(id){
			var conf = confirm("ต้องการจะลบข้อมูลนี้?"+id);
			if (conf == true) {
				window.location.href="delete-report.php?id="+id;
			}
		}
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