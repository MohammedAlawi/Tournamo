<?php



function getTypeFile($fileName) {
	$ext = pathinfo($fileName, PATHINFO_EXTENSION);
	switch ($ext){
		case 'doc':
		case 'docm':
		case 'docx':
		case 'dot':
		case 'dotm':
		case 'dotx':
			$type = 'word';
			break;
		
		case 'xla':
		case 'xlam':
		case 'xls':
		case 'xlsb':
		case 'xlsm':
		case 'xlsx':
		case 'xlt':
		case 'xltm':
		case 'xltx':
		case 'xlw':
			$type = 'excel';
			break;
		
		case 'pot':
		case 'potm':
		case 'potx':
		case 'ppa':
		case 'ppam':
		case 'pps':
		case 'ppsm':
		case 'ppsx':
		case 'ppt':
		case 'pptm':
		case 'pptx':
		case 'pptx':
			$type = 'powerpoint';
			break;
		
		case 'pdf':
			$type = 'pdf';
			break;
		
		case 'png':
		case 'jpeg':
		case 'jpg':
		case 'gif':
			$type = 'img';
			break;
		
		case 'txt':
			$type = 'alt';
			break;
		
		
		default:
			$type = null;
	}
	
	return $type;
}


function formatSizeUnits($bytes) {
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}

	return $bytes;
}


function downloadFile($file, $downloadFileName) {
	set_time_limit(0);
	ini_set('max_execution_time', 0);
	ini_set("memory_limit","1024M");  
	$maxRead = 1 * 1024 * 1024; // 1MB
	// $fileName = pathinfo($file)['basename'];
	$fileName = $downloadFileName;
	
	$file = PATH_UPLOAD.$file;
	if(is_file($file) !== false){
		
		$fh = fopen($file, 'r');
		
		header('Content-Type: application/octet-stream');
	    header("Content-Transfer-Encoding: Binary"); 
		header('Content-Disposition: attachment; filename="' . $fileName . '"');

		ob_start();

		while (!feof($fh)) {
			echo fread($fh, $maxRead);

			ob_flush();
		}
	}
	exit;
}