<?php

require("/membri/studyroompoli/cfg/sql.php");
require("/membri/studyroompoli/logs/testip.php");


$course_file="data.json";

// CHECK TEXTDATA
if((strcmp($_POST['txtdata'],"")==0) or (strcmp($_POST['txtdata'],"\n")==0)) {
	die("<html><body><h1>EMPTY REQUEST!</h1></body></html>\n");
}

// REQUEST UID, IP & QUERY SQL
$reqid = uniqid();
$dbcomm = "INSERT INTO `log_corsielt` (`ip`,`reqid`, `country`) VALUES (\"".$ip."\",\"".$reqid."\",\"".$country_ID."\");";
if (!($dbobj->query($dbcomm))) {
	die("<html><body><h1>INTERNAL SQL ERROR!</h1></body></html>\n");
}

// LOGGING REQUEST
$objdat = fopen('/membri/studyroompoli/logs/etf_job.txt', "a+");
fwrite($objdat, "REQUEST: ".$reqid."\n");
fwrite($objdat, "Company:\n".$_POST['txtazienda']."\n");
fwrite($objdat, "Role:\n".$_POST['txtruolo']."\n");
fwrite($objdat, "Reward:\n".$_POST['txtpaga']."\n");
fwrite($objdat, "Net flag:\n".$_POST['isnetto']."\n");
fwrite($objdat, "Data:\n".$_POST['txtdata']."\n");
fwrite($objdat, "Country: ".$country."\n\n");
fclose($objdat);

// LOCK & EDIT COURSE JSON
$f = fopen($course_file, 'r+');
$i=0;
$N=15;
while(!flock($f, LOCK_EX | LOCK_NB)) {
	$i++;
	if($i==$N)
		die("<html><body><h1>TIMEOUT ERROR!</h1></body></html>\n");
	sleep(1);
}
$json_data=file_get_contents($course_file);
$json_arr=json_decode($json_data,true);
$json_arr[]=[];
$jkey_last=array_key_last($json_arr);
$date = (new DateTime('NOW'))->format("Y-m-d");
$json_arr[$jkey_last]['azienda']="[".$date."] ".$_POST['txtazienda'];
$json_arr[$jkey_last]['ruolo']=$_POST['txtruolo'];
if($_POST['isnetto']=='1')
	$json_arr[$jkey_last]['mese']=$_POST['txtpaga'];
else
	$json_arr[$jkey_last]['ral']=$_POST['txtpaga'];
$json_arr[$jkey_last]['data']=$_POST['txtdata'];
$json_data=json_encode($json_arr);
file_put_contents($course_file,$json_data);
flock($f, LOCK_UN);
fclose($f);

// REDIRECT TO INFO PAGE
if(isset($_GET['en']))
	$redir= "index.php?en";
else
	$redir= "index.php";
header('Location: '.$redir);
?>
