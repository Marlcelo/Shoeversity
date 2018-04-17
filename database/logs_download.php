<?php
	include_once('../libs/PHPExcel/Classes/PHPExcel/IOFactory.php');
	$inputFileName = "../templates/MS Excel/LogsTemplate.xlsx";
	$outfilename = "ShoeversityLogs_". date("Y-m-d") . '.xlsx';

	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);

	$objPHPExcel->setActiveSheetIndex(0);

	$genDate = 'Generated on '.date("l jS \of F Y");
	$objPHPExcel->getActiveSheet()
				->setCellValue('A2', $genDate);

	// write logs to excel file
	require 'config.php';
  	$sql = "CALL SP_GET_ALL_LOGS()";
  	$result = mysqli_query($conn, $sql);

  	$row = 4; // row starts at 4 due to excel headers
  	while($log=mysqli_fetch_assoc($result)) {

  		$objPHPExcel->getActiveSheet()
  					->setCellValue('A'.$row, $log['uid'].".")
  					->setCellValue('B'.$row, $log['username'])
  					->setCellValue('C'.$row, $log['log_action'])
  					->setCellValue('D'.$row, $log['time_stamp']);

  		$row++;
  	}

	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . $outfilename . '"');
	header('Cache-Control: max-age=0');

	// Save to output file
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>