<!DOCTYPE html>
<html>
<head>
<meta name="language" content="en-th" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<img src="hd-13.jpg" width="100%">
</head>
<body>
</body>
</html>
<?php
require 'dbconnect.php';
date_default_timezone_set('Asia/Bangkok');
// error_reporting(0);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';

$locate = (isset($_POST['locate']))?$_POST["locate"]:'';
$year = (isset($_POST['year']))?$_POST["year"]:'';
$cdate = date("Y-m-d H:i:s");

$file = $_FILES['file_upload'];
$Name = $_FILES['file_upload']['name'];
$TempName = $_FILES['file_upload']['tmp_name'];
$Size = $_FILES['file_upload']['size'];
$Error = $_FILES['file_upload']['error'];
$type = $_FILES['file_upload']['type'];
$ext = explode('.',$Name);
$actualext= strtolower(end($ext));
$allowed= array('xls','xlsx');

if (!empty($file) || !empty($locate) || !empty($year)) {
if (in_array($actualext,$allowed)) {
	if ($Error === 0) {
		if ($Size < 10000000) {
			$newname = ($locate=='1')?'SP.':'TR.';
			$newname .= $actualext;
			$fileDestination = 'file_upload/'.$newname;
			move_uploaded_file($TempName, $fileDestination);

			// echo "<script type='text/javascript'>alert('Save successfully!'); javascript:window.close();</script>";//Save successfully!
			$inputFileName = $fileDestination;
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);

			// call sheet 1
			$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

			if ($locate == 1) {
				// ========================= SP locate ================================== //
				// find data cell in excel 1.1
				$dataRow = $objWorksheet->rangeToArray('B7:J12',null, true, true, true);
				$delete = "DELETE FROM new_report WHERE year='".$year."' AND locate_type='".$locate."'";
				$deleteQuery = mysqli_query($conn, $delete) or trigger_error($conn->error);

				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 7) {
						$strSQL .="('".'sp1810'."'";
					} elseif ($key == 8) {
						$strSQL .="('".'sp1410'."'";
					} elseif ($key == 9) {
						$strSQL .="('".'sp1610'."'";
					} elseif ($key == 10) {
						$strSQL .="('".'sp1910'."'";
					} elseif ($key == 11) {
						$strSQL .="('".'sp1710'."'";
					} elseif ($key == 12) {
						$strSQL .="('".'sp1510'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 1.2
				$dataRow = $objWorksheet->rangeToArray('B15:J19',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 15) {
						$strSQL .="('".'sp1210'."'";
					} elseif ($key == 16) {
						$strSQL .="('".'sp1310'."'";
					} elseif ($key == 17) {
						$strSQL .="('".'sp7310'."'";
					} elseif ($key == 18) {
						$strSQL .="('".'sp1110'."'";
					} elseif ($key == 19) {
						$strSQL .="('".'sp1010'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 1.3
				$dataRow = $objWorksheet->rangeToArray('B22:J24',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 22) {
						$strSQL .="('".'sp7110'."'";
					} elseif ($key == 23) {
						$strSQL .="('".'sp7010'."'";
					} elseif ($key == 24) {
						$strSQL .="('".'sp7210'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 1.4
				$dataRow = $objWorksheet->rangeToArray('B27:J30',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 27) {
						$strSQL .="('".'sp7710'."'";
					} elseif ($key == 28) {
						$strSQL .="('".'sp7610'."'";
					} elseif ($key == 29) {
						$strSQL .="('".'sp7510'."'";
					} elseif ($key == 30) {
						$strSQL .="('".'sp7410'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 2.1
				$dataRow = $objWorksheet->rangeToArray('B35:J39',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 35) {
						$strSQL .="('".'sp8610'."'";
					} elseif ($key == 36) {
						$strSQL .="('".'sp8010'."'";
					} elseif ($key == 37) {
						$strSQL .="('".'sp9310'."'";
					} elseif ($key == 38) {
						$strSQL .="('".'sp8410'."'";
					} elseif ($key == 39) {
						$strSQL .="('".'sp9010'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 2.2
				$dataRow = $objWorksheet->rangeToArray('B42:J47',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 42) {
						$strSQL .="('".'sp8110'."'";
					} elseif ($key == 43) {
						$strSQL .="('".'sp9210'."'";
					} elseif ($key == 44) {
						$strSQL .="('".'sp8210'."'";
					} elseif ($key == 45) {
						$strSQL .="('".'sp8310'."'";
					} elseif ($key == 46) {
						$strSQL .="('".'sp8510'."'";
					} elseif ($key == 47) {
						$strSQL .="('".'sp9110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 3.1
				$dataRow = $objWorksheet->rangeToArray('B52:J54',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 52) {
						$strSQL .="('".'sp9610'."'";
					} elseif ($key == 53) {
						$strSQL .="('".'sp9410'."'";
					} elseif ($key == 54) {
						$strSQL .="('".'sp9510'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 4.1
				$dataRow = $objWorksheet->rangeToArray('B59:J61',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 59) {
						$strSQL .="('".'sp2410'."'";
					} elseif ($key == 60) {
						$strSQL .="('".'sp2010'."'";
					} elseif ($key == 61) {
						$strSQL .="('".'sp2110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 4.2
				$dataRow = $objWorksheet->rangeToArray('B64:J68',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 64) {
						$strSQL .="('".'sp2210'."'";
					} elseif ($key == 65) {
						$strSQL .="('".'sp2310'."'";
					} elseif ($key == 66) {
						$strSQL .="('".'sp2610'."'";
					} elseif ($key == 67) {
						$strSQL .="('".'sp2510'."'";
					} elseif ($key == 68) {
						$strSQL .="('".'sp2710'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 5.1
				$dataRow = $objWorksheet->rangeToArray('B73:J77',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 73) {
						$strSQL .="('".'sp3810'."'";
					} elseif ($key == 74) {
						$strSQL .="('".'sp4210'."'";
					} elseif ($key == 75) {
						$strSQL .="('".'sp4310'."'";
					} elseif ($key == 76) {
						$strSQL .="('".'sp3910'."'";
					} elseif ($key == 77) {
						$strSQL .="('".'sp4110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 5.2
				$dataRow = $objWorksheet->rangeToArray('B80:J82',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 80) {
						$strSQL .="('".'sp4810'."'";
					} elseif ($key == 81) {
						$strSQL .="('".'sp4910'."'";
					} elseif ($key == 82) {
						$strSQL .="('".'sp4710'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 5.3
				$dataRow = $objWorksheet->rangeToArray('B85:J88',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 85) {
						$strSQL .="('".'sp4610'."'";
					} elseif ($key == 86) {
						$strSQL .="('".'sp4010'."'";
					} elseif ($key == 87) {
						$strSQL .="('".'sp4410'."'";
					} elseif ($key == 88) {
						$strSQL .="('".'sp4510'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 5.4
				$dataRow = $objWorksheet->rangeToArray('B91:J94',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 91) {
						$strSQL .="('".'sp3610'."'";
					} elseif ($key == 92) {
						$strSQL .="('".'sp3010'."'";
					} elseif ($key == 93) {
						$strSQL .="('".'sp3110'."'";
					} elseif ($key == 94) {
						$strSQL .="('".'sp3210'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 5.5
				$dataRow = $objWorksheet->rangeToArray('B97:J100',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 97) {
						$strSQL .="('".'sp3510'."'";
					} elseif ($key == 98) {
						$strSQL .="('".'sp3310'."'";
					} elseif ($key == 99) {
						$strSQL .="('".'sp3710'."'";
					} elseif ($key == 100) {
						$strSQL .="('".'sp3410'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 6.1
				$dataRow = $objWorksheet->rangeToArray('B105:J108',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 105) {
						$strSQL .="('".'sp5010'."'";
					} elseif ($key == 106) {
						$strSQL .="('".'sp5810'."'";
					} elseif ($key == 107) {
						$strSQL .="('".'sp5210'."'";
					} elseif ($key == 108) {
						$strSQL .="('".'sp5110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 6.2
				$dataRow = $objWorksheet->rangeToArray('B111:J114',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 111) {
						$strSQL .="('".'sp5010'."'";
					} elseif ($key == 112) {
						$strSQL .="('".'sp5810'."'";
					} elseif ($key == 113) {
						$strSQL .="('".'sp5210'."'";
					} elseif ($key == 114) {
						$strSQL .="('".'sp5110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 6.3
				$dataRow = $objWorksheet->rangeToArray('B117:J121',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 117) {
						$strSQL .="('".'sp6310'."'";
					} elseif ($key == 118) {
						$strSQL .="('".'sp6510'."'";
					} elseif ($key == 119) {
						$strSQL .="('".'sp6710'."'";
					} elseif ($key == 120) {
						$strSQL .="('".'sp6410'."'";
					} elseif ($key == 121) {
						$strSQL .="('".'sp5310'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
				// find data cell in excel 6.4
				$dataRow = $objWorksheet->rangeToArray('B124:J127',null, true, true, true);
				foreach ($dataRow as $key => $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($key == 124) {
						$strSQL .="('".'sp6210'."'";
					} elseif ($key == 125) {
						$strSQL .="('".'sp6010'."'";
					} elseif ($key == 126) {
						$strSQL .="('".'sp6610'."'";
					} elseif ($key == 127) {
						$strSQL .="('".'sp6110'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['C']."' ";
					$strSQL .=",'".$value['D']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['I']."','".$value['J']."','".$value['B']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
				}
			} else {
				// ========================= TR locate ================================== //
				// find data cell in excel C8-I26
				$i = 1;
				$dataRow = $objWorksheet->rangeToArray('C8:I26',null, true, true, true);
				$delete = "DELETE FROM new_report WHERE year='".$year."' AND locate_type='".$locate."'";
				$deleteQuery = mysqli_query($conn, $delete) or trigger_error($conn->error);

				foreach ($dataRow as $value) {
					$strSQL = "INSERT INTO new_report ";
					$strSQL .="(division, year, locate_type, round1_person, round1_percent, round2_person, round2_percent, round3_person, round3_percent, sum, create_date) ";
					$strSQL .="VALUES ";
					if ($i == 1) {
						$strSQL .="('".'tr2130'."'";
					} elseif ($i == 2) {
						$strSQL .="('".'tr7030'."'";
					} elseif ($i == 3) {
						$strSQL .="('".'tr3030'."'";
					} elseif ($i == 4) {
						$strSQL .="('".'tr4030'."'";
					} elseif ($i == 5) {
						$strSQL .="('".'tr3430'."'";
					} elseif ($i == 6) {
						$strSQL .="('".'tr6030'."'";
					} elseif ($i == 7) {
						$strSQL .="('".'tr5030'."'";
					} elseif ($i == 8) {
						$strSQL .="('".'tr8430'."'";
					} elseif ($i == 9) {
						$strSQL .="('".'tr9030'."'";
					} elseif ($i == 10) {
						$strSQL .="('".'tr1032'."'";
					} elseif ($i == 11) {
						$strSQL .="('".'tr1630'."'";
					} elseif ($i == 12) {
						$strSQL .="('".'tr1033'."'";
					} elseif ($i == 13) {
						$strSQL .="('".'tr1034'."'";
					} elseif ($i == 14) {
						$strSQL .="('".'tr1035'."'";
					} elseif ($i == 15) {
						$strSQL .="('".'tr1031'."'";
					} elseif ($i == 16) {
						$strSQL .="('".'tr2030'."'";
					} elseif ($i == 17) {
						$strSQL .="('".'tr1430'."'";
					} elseif ($i == 18) {
						$strSQL .="('".'tr9630'."'";
					} elseif ($i == 19) {
						$strSQL .="('".'tr1036'."'";
					}
					$strSQL .=",'".$year."','".$locate."','".$value['D']."' ";
					$strSQL .=",'".$value['E']."','".$value['F']."','".$value['G']."' ";
					$strSQL .=",'".$value['H']."','".$value['I']."','".$value['C']."','".$cdate."') ";
					$objQuery = mysqli_query($conn, $strSQL);
					$i++;
				}
			}
		}	else {
			// echo "<script type='text/javascript'>alert('Error!! File size is too large');javascript:history.go(-1);</script>";//Error!! File size is too large
		}
	}	else {
		// echo "<script type='text/javascript'>alert('Error in uploading the file');javascript:history.go(-1);</script>";//Error in uploading the file
	}
} else {
	// echo "<script type='text/javascript'>alert('Error!! File Extention not Correct');javascript:history.go(-1);</script>";//Error!! File Extention not Correct
}
} else {
  echo "<br><br><font color='red' size='6' ><center>ไม่สำเร็จ : กรุณาระบุข้อมูลให้ครบถ้วน</center></font>";
  mysql_close();
  header('refresh: 1; url=form_upload.php');
}

if ($objQuery) {
  echo "<br><br><font color='green' size='6' ><center>สำเร็จ : อัพเดทข้อมูลสำเร็จ</center></font>";
  mysqli_close($conn);
  header('refresh: 1; url=page-admin.php');
} else {
  echo "<br><br><font color='red' size='6' ><center>ไม่สำเร็จ : อัพเดทข้อมูลไม่สำเร็จ</center></font>";
  mysqli_close($conn);
  header('refresh: 1; url=form_upload.php');
}
?>
