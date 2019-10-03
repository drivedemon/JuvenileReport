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
		td{
			border:1px solid gray;
		}
		.center{
			padding-left: 100px
		}
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
		<div class="container text-center center">
			<h5 align="center">ร้อยละของเด็กและเยาวชนที่กระทำผิดซ้ำ<br>ภายหลังจากได้รับการปล่อยตัวจากศูนย์ฝึกและอบรมเด็กและเยาวชน<br>ปีงบประมาณ <?=$yearSelect?></h5>

		</div>
		<div class="container d-inline-flex">
			<div class="col-3 hidden">
			</div>
			<div class="col-9">
				<div class="hiddenContent" id="table0">
					<!-- ตาราง 1 -->
					<div class="container table-responsive p-1">
						<table width="100%" class="table table-bordered table-sm" style="background-color:white;">
							<thead>
								<tr class="table-secondary text-center">
								<col>
								<colgroup span="2"></colgroup>
								<colgroup span="2"></colgroup>
								  <tr class="table-secondary text-center">
										<td rowspan="2" align="center" width="10%"><br>หน่วยงาน</td>
										<td rowspan="2" align="center" width="15%">จำนวนที่ส่งตรวจสอบประวัติการกระทำผิดซ้ำ(คน)</td>
								    <td colspan="2" align="center" scope="colgroup" width="25%">ภายใน 1 ปี</td>
								    <td colspan="2" align="center" scope="colgroup" width="25%">ภายใน 2 ปี</td>
								    <td colspan="2" align="center" scope="colgroup" width="25%" >ภายใน 3 ปี</td>
								  </tr>
								  <tr class="table-secondary text-center">
								    <td scope="col" align="center">จำนวน ด/ย<br>ที่ถูกจับซ้ำ(คน)</td>
								    <td scope="col" align="center">ด/ย ที่ถูกจับ<br>ซ้ำคิดเป็นร้อยละ</td>
								    <td scope="col" align="center">จำนวน ด/ย<br>ที่ถูกจับซ้ำ(คน)</td>
								    <td scope="col" align="center">ด/ย ที่ถูกจับ<br>ซ้ำคิดเป็นร้อยละ</td>
								    <td scope="col" align="center">จำนวน ด/ย<br>ที่ถูกจับซ้ำ(คน)</td>
								    <td scope="col" align="center">ด/ย ที่ถูกจับ<br>ซ้ำคิดเป็นร้อยละ</td>
								  </tr>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql_detail = "SELECT * FROM report WHERE date_year='$yearSelect' AND round='1' ORDER BY receiver AND date_month DESC";
									$query_detail = mysqli_query($conn, $sql_detail);

									while ($data_detail = mysqli_fetch_array($query_detail)){
										$sql_receiver = "SELECT name FROM user WHERE id=".$data_detail['receiver']."";
										$query_receiver = mysqli_query($conn,$sql_receiver);
										$data_receiver = mysqli_fetch_array($query_receiver);
										$sql_month = "SELECT name FROM month_db WHERE id=".$data_detail['date_month']."";
										$query_month = mysqli_query($conn,$sql_month);
										$data_month = mysqli_fetch_array($query_month);
								?>
									<tr>
										<td><?php echo $data_receiver['name']; ?></td>
										<td><?php echo $data_month['name']; ?></td>
										<td><?php echo $data_detail['sentNum']; ?></td>
										<td><?php echo $data_detail['catchNum']; ?></td>
										<td><?php echo $data_detail['catchPer']; ?></td>
										<td><?php echo $data_detail['sentNum']; ?></td>
										<td><?php echo $data_detail['catchNum']; ?></td>
										<td><?php echo $data_detail['catchPer']; ?></td>
									</tr>
								<?php }; ?>
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
									<td>รวม</td>
									<td></td>
									<td><?php echo $data_sum['sum(sentNum)']; ?></td>
									<td><?php echo $data_sum['sum(catchNum)']; ?></td>
									<td><?php echo $percentage; ?></td>
									<td class="hidden"></td>
									<td class="hidden"></td>
								</tr>
								<tr class="table-secondary">
									<td>Max / Min</td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo $data_sum['max(catchPer)']; ?> / <?php echo $data_sum['min(catchPer)']; ?></td>
									<td class="hidden"></td>
									<td class="hidden"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<?php }	?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
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
	</script>
  </body>
</html>
