<?php
// NOME FILE E CONTROLLO
$data_file="data/".$_GET['id']."/data.json";
$json_data=file_get_contents($data_file);
if(!$json_data) {
	die("<h1>ID NOT FOUND!</h1>\n");
}
$json_arr=json_decode($json_data,true);
if(!$json_arr['open']) {
	die("<h1>ID LOCKED!</h1>\n");
}
if($_POST['txtdata']==null) {
	die("<h1>EMPTY POST REQUEST!</h1>\n");
}
// LOCK AND WRITE
$f = fopen($data_file, 'r+');
$i=0;
$N=15;
while(!flock($f, LOCK_EX | LOCK_NB)) {
	$i++;
	if($i==$N)
		die("<h1>Timeout error, server busy!</h1>\n");
	sleep(1);
}
$json_data=file_get_contents($data_file);
$json_arr=json_decode($json_data,true);
$json_arr["domande"][]=$_POST['txtdata'];
$json_data=json_encode($json_arr);
file_put_contents($data_file,$json_data);
flock($f, LOCK_UN);
fclose($f);
header('Location: view.php?id='.$_GET['id']);
?>
