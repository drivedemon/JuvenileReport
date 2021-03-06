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
    <title>ลงทะเบียน</title>
  </head>
<!-- Body -->
  <body>
	<div class="container pt-3 text-center">
		<h3>ลงทะเบียน</h3>
	</div>
	<!-- Form -->
	<div class="container" style="width:800px;">
	<br />
	<br />
		<form name="register" action="register-sent.php" method="post" enctype="multipart/form-data" id="register">
			<!-- input -->
			<div class="form-group row">
				<label for="input-name" class="col-sm-2 col-form-label">Name:</label>
				<div class="col-sm-10">
					<input type="text" name="txtName" class="form-control" id="input-name" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-group" class="col-sm-2 col-form-label">Group:</label>
				<div class="col-sm-10">
					<select class="form-control" name="txtGroup" id="input-group">

						<option value="2">หน่วยงานในสังกัด</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-user" class="col-sm-2 col-form-label">Username:</label>
				<div class="col-sm-10">
					<input type="text" name="txtUser" class="form-control" id="input-user" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="input-pass" class="col-sm-2 col-form-label">Password:</label>
				<div class="col-sm-10">
					<input type="password" name="txtPass" class="form-control" id="input-pass" required>
				</div>
			</div>
			<div class="form-group text-center">
				<div>
					<button type="submit" class="btn btn-primary">ส่ง</button>
				</div>
			</div>
		</form>
	</div>
	<br />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script>

	</script>
  </body>
</html>
