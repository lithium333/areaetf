<?php
// NOME FILE E CONTROLLO
$data_file="data/".$_GET['id']."/data.json";
$json_data=file_get_contents($data_file);
if(!$json_data) {
	die("<h1>ID NOT FOUND!</h1>\n");
}
// HEADER
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
if(isset($_GET['json']))
	header('Content-Disposition: attachment; filename='.$_GET['id'].'.json');
else
	header('Content-Disposition: attachment; filename='.$_GET['id'].'.txt');
header('Pragma: public');
// MODE
if(isset($_GET['json'])) {
	readfile($data_file);
} else {
	// GENERATE TEXT
	$json_arr=json_decode($json_data,true);
	echo "\xEF\xBB\xBF"; //UTF-8 BOM
	echo $json_arr['title']."\n";
	$i=1;
	foreach ($json_arr['domande'] as $jdata) {
		echo "\n".$i."):\n";
		echo $jdata."\n";
		$i++;
	}
}

die();
?>
