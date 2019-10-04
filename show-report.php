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
	<?php
	if(isset($_POST['yearSelect']) || isset($_GET['year']) || isset($_POST['t']) || isset($_GET['t'])) {
		if(isset($_POST['yearSelect']) || isset($_POST['t'])) {
			$yearSelect = $_POST["yearSelect"];
			$type = $_POST["t"];
		} else {
			$yearSelect = $_GET["year"];
			$type = $_GET["t"];
	?>
			<button class="btn btn-light float-right hidden" style="border:1px solid gray; margin-right:50px; margin-top:10px;" onclick="print()">พิมพ์</button>
	<?php
		}
	?>
		<div class="container text-center center">
			<h5 align="center">
				<?php
				if ($type == 1) {
					echo "ตารางสรุปการกระทำผิดซ้ำรายสถานพินิจจังหวัด ปีงบประมาณ $yearSelect";
				} else {
					echo "ร้อยละของเด็กและเยาวชนที่กระทำผิดซ้ำ<br>ภายหลังจากได้รับการปล่อยตัวจากศูนย์ฝึกและอบรมเด็กและเยาวชน<br>ปีงบประมาณ $yearSelect";
				}
				?>
			</h5>
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
										<td scope="col"  align="center">จำนวน ด/ย<br>ที่ถูกจับซ้ำ(คน)</td>
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
								$sql_detail = "SELECT u.name, nr.round1_person, nr.round1_percent, nr.round2_person, nr.round2_percent, nr.round3_person, nr.round3_percent, nr.sum
								FROM new_report nr LEFT JOIN user u ON nr.division=u.username WHERE nr.year='$yearSelect' and nr.locate_type='$type' ORDER BY nr.id";
								$query_detail = mysqli_query($conn, $sql_detail);

								while ($data_detail = mysqli_fetch_assoc($query_detail)) {
									?>
									<tr>
										<td><?=$data_detail['name']?></td>
										<td align="center"><?=$data_detail['sum']?></td>
										<td align="center"><?=$data_detail['round1_person']?></td>
										<td align="center"><?=$data_detail['round1_percent']?></td>
										<td align="center"><?=$data_detail['round2_person']?></td>
										<td align="center"><?=$data_detail['round2_percent']?></td>
										<td align="center"><?=$data_detail['round3_person']?></td>
										<td align="center"><?=$data_detail['round3_percent']?></td>
									</tr>
									<?php
								};
								$sql_sum = "SELECT SUM(sum) as totalsum, SUM(round1_person) as r1_sum, SUM(round2_person) as r2_sum, SUM(round3_person) as r3_sum
								FROM new_report WHERE year='$yearSelect' AND locate_type='1'";
								$query_sum = mysqli_query($conn, $sql_sum);
								$data_sum = mysqli_fetch_assoc($query_sum);
								?>
								<tr class="table-secondary">
									<td>รวม</td>
									<td align="center"><?=$data_sum['totalsum']?></td>
									<td align="center"><?=$data_sum['r1_sum']?></td>
									<td align="center"><?=(isset($data_sum['totalsum']) && isset($data_sum['r1_sum']) && $data_sum['totalsum'] != '0')?number_format($data_sum['r1_sum']/$data_sum['totalsum']*100, 2, '.', ','):''?></td>
									<td align="center"><?=$data_sum['r2_sum']?></td>
									<td align="center"><?=(isset($data_sum['totalsum']) && isset($data_sum['r2_sum']) && $data_sum['totalsum'] != '0')?number_format($data_sum['r2_sum']/$data_sum['totalsum']*100, 2, '.', ','):''?></td>
									<td align="center"><?=$data_sum['r3_sum']?></td>
									<td align="center"><?=(isset($data_sum['totalsum']) && isset($data_sum['r3_sum']) && $data_sum['totalsum'] != '0')?number_format($data_sum['r3_sum']/$data_sum['totalsum']*100, 2, '.', ','):''?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
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
