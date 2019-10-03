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
	<div class="container-fluid pt-3 text-center">
		<img class="img-fluid" src="hd-13.jpg"/>
		<div class="container" style="width:800px;">
			<label class="col-form-label"><h5>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</h5></label>
			<form name="yearSent" action="show-report.php" method="post" enctype="multipart/form-data" id="report-form" target="showReport">
				<input type="hidden" id="type" name="t" value="<?=$_GET['t']?>">
				<div class="form-group row mx-auto">
					<label for="year" class="col-sm-2 col-form-label">ปีงบประมาณ:</label>
					<div class="col-sm-9">
						<select class="form-control" id="yearSelect" name="yearSelect">
							<option value="0">---โปรดเลือกปีงบประมาณ---</option>
							<?php $current = date("Y")+543;
								for($y=2558;$y<=$current+1;$y++){ ?>
									<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-1">
						<button type="submit" class="btn btn-light" style="border:1px solid gray;">เลือก</button>
					</div>
				</div>
			</form>
		</div>
		<iframe id="showReport" name="showReport" src="show-report.php" width="100%" height="330">
			<p>เบราว์เซอร์ของคุณไม่รองรับiframe</p>
		</iframe>
		<button class="btn btn-light" style="border:1px solid gray;" onclick="print()">พิมพ์</button>
		<a class="btn btn-light" style="border:1px solid gray;" id="toNewTab" onclick="newTab()">เปิดในเท็บใหม่</a>
		<br/>
		<div class="text-center">
			<a href="javascript:window.close()">ปิดหน้าต่าง</a> |
			<a href="logout.php">Logout</a>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script>
		function print(){
			window.frames["showReport"].focus();
			window.frames["showReport"].print();
		}
		function newTab(){
			year = $("#yearSelect").val();
			type = $("#type").val();
			link = "show-report.php?year="+year+"&t="+type;
			window.open(link,'_blank');
		}
	</script>
  </body>
</html>
