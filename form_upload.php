<?php
session_start();
error_reporting(~E_NOTICE);
if($_SESSION["user"] == ""){
  echo "Please Login";
  exit();
}

if($_SESSION["permission"] != "1"){
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
<body style="background-color: rgb(248, 255, 255);">
  <div class="container pt-3 text-center">
    <h3><img src="hd-13.jpg" width="1000" height="150"></h3>
  </div>
  <!-- Form -->
  <div class="container p-2" style="max-width:800px;">
    <div class="container p-2 text-center">
      <label class="col-form-label">Upload Excel file</label>
    </div>
    <div class="form-group row" style="border-style:solid; background-color: rgb(230, 255, 255); border-width:2px; border-color: rgb(225, 255, 255); border-radius: 8px !important;">
      <form name="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" id="report-form" onSubmit="JavaScript:return fncSubmit();">
        <label class="col-form-label"></label>

        <div class="form-group row">
          <div class="col-sm-1"></div>
          <label for="input-round" class="col-sm-2 col-form-label" style="margin-top: -8px;">เลือกสถานที่ :</label>
          <div class="col-sm-9">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="locate" id="locate1" checked value="1" required />
              <label class="form-check-label" for="locate1">สถานพินิจ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="locate" id="locate2" value="2" required />
              <label class="form-check-label" for="locate2">ศูนย์ฝึก</label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-1"></div>
          <label class="col-sm-2 col-form-label">เลือกปี :</label>
          <div class="col-sm-5">
            <select id="years" name="year" class="browser-default custom-select" required>
              <?php $current = date("Y")+543;
              for($y=2558;$y<=$current+1;$y++){ ?>
                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="input-group">
          <div class="col-md-1"></div>
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file_upload" id="file-upload" aria-describedby="inputGroupFileAddon01" accept=".xls,.xlsx,.rar">
            <label class="custom-file-label" for="file-upload" id="file-upload-filename">Choose file</label>
            <small class="form-text text-muted">รองรับ ไฟล์ .pdf / .jpg เท่านั้น ขนาดไม่เกิน 10 MB / ไฟล์.</small>
          </div>
        </div>
        <small class="form-text text-muted" style="margin-left: 60px;">รองรับ ไฟล์ .xls, .xlsx เท่านั้น ขนาดไม่เกิน 10 MB / ไฟล์.</small>
        <label class="col-form-label"></label>

      </div>

      <div class="form-group text-right">
        <div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    <div class="text-center">
      <a href="javascript:window.close()" class="btn btn-secondary">ปิดหน้าต่าง</a> |
  			<a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  <script language="javascript">
  var input = document.getElementById( 'file-upload' );
  var infoArea = document.getElementById( 'file-upload-filename' );
  input.addEventListener( 'change', showFileName );
  function showFileName( event ) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = fileName;
  }
  function fncSubmit() {
    var locate = document.forms["uploadForm"]["locate"].value;
    var year = document.forms["uploadForm"]["year"].value;
    var file = document.forms["uploadForm"]["file_upload"].value;
    if (locate == null || locate == "", year == null || year == "", file == null || file == "") {
      if (locate == null || locate == "") {
        alert("Please Fill the locate type.");
        return false;
      } else if (year == null || year == "") {
        alert("Please Fill the year.");
        return false;
      } else if (file == null || file == "") {
        alert("Please Fill the file upload.");
        return false;
      }
    } else {
      return true;
    }
  }
  </script>
</body>
</html>
