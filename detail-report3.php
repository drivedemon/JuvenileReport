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
	
	include 'dbconnect.php';
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
		
	<!-- Style CSS -->
	<style>
	
	</style>
	
    <title>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</title>
	
  </head>
  
<!-- Body -->  
  <body>
	<div class="container-fluid pt-3 text-center">
		<h3>
			<img class="img-fluid" src="hd-13.jpg"></h3>
		<h3>รายงานยอดเด็ก/เยาวชนกระทำผิดซ้ำ</h3>
		<div class="container" >
			<form name="yearSent" action="show-report3.php" method="post" enctype="multipart/form-data" id="report-form" target="showReport">
				<div class="row">
					<div class="form-group col-6 row mx-auto">
						<label for="year" class="col-sm-3 col-form-label">ปีงบประมาณ:</label>
						<div class="col-sm-9">
							<select class="form-control" id="yearSelect" name="yearSelect">
								<option value="0">---โปรดเลือกปีงบประมาณ---</option>
								<?php $current = date("Y")+543; 
									for($y=2558;$y<=$current+1;$y++){ ?>
										<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>				
					<div class="form-group col-6 row mx-auto">
						<label for="year" class="col-sm-3 col-form-label">ศุนย์ฝึกฯ:</label>
						<div class="col-sm-9">
							<select class="form-control" name="selectReceiver" id="select-receiver">
								<option value="0">---โปรดเลือกศุนย์ฝึกฯ---</option>
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
				</div>	
				<div class="col-1 mx-auto">
					<button type="submit" class="btn btn-light mb-1" style="border:1px solid gray;">เลือก</button>
				</div>				
			</form>
		</div>
		<iframe id="showReport" name="showReport" src="show-report3.php" width="100%" height="330">
			<p>เบราว์เซอร์ของคุณไม่รองรับiframe</p>
		</iframe>
		<button class="btn btn-light" style="border:1px solid gray;" onclick="print()">พิมพ์</button>
		<a class="btn btn-light" style="border:1px solid gray;" id="toNewTab" onclick="newTab()">เปิดในเท็บใหม่</a>
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
		function print(){
			window.frames["showReport"].focus();
			window.frames["showReport"].print();
		}				
		function newTab(){
			$link = "show-report3.php?year="+$("#yearSelect").val()+"&to="+$("#select-receiver").val();
			window.open($link,'_blank');
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