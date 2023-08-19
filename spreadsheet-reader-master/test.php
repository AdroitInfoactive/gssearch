<?php
	header('Content-Type: text/plain');
	require('php-excel-reader/excel_reader2.php');
	require('SpreadsheetReader.php');
	date_default_timezone_set('UTC');
		$Spreadsheet = new SpreadsheetReader('vengafashion.xlsx');
		$Sheets = $Spreadsheet -> Sheets();
		foreach ($Sheets as $Index => $Name)
		{
			$Time = microtime(true);
			$Spreadsheet -> ChangeSheet($Index);
			foreach ($Spreadsheet as $Key => $Row)
			{
				echo $Key.': ';
				if ($Row)
				{
					print_r($Row);
				}
				
			}
		
		
		}
		

?>
