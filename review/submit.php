<?php

require("/membri/studyroompoli/cfg/sql.php");
require("/membri/studyroompoli/logs/testip.php");

// TRY OPENING DATA
$course_file="cont/".$_GET['id'].".json";
$course_fobj=fopen($course_file,"r");
if(!$course_fobj) {
	die("<html><body><h1>QUERY ERROR!</h1></body></html>\n");
}
$jdata=file_get_contents($course_file);
$jarr=json_decode($jdata,true);

// CHECK TEXTDATA
if((strcmp($_POST['txtdata'],"")==0) or (strcmp($_POST['txtdata'],"\n")==0)) {
	die("<html><body><h1>EMPTY REQUEST!</h1></body></html>\n");
}

// OPMODE CHECK
switch($_GET['mode']) {
	case "pro":
		$t="PRO";
		$jt="pro";
		break;
	case "con":
		$t="CON";
		$jt="not";
		break;
	case "exm":
		$t="EXAM";
		$jt="exm";
		break;
	default:
		die("<html><body><h1>QUERY ERROR!</h1></body></html>\n");
}

// REQUEST UID, IP & QUERY SQL
$reqid = uniqid();
$dbcomm = "INSERT INTO `log_corsielt` (`ip`,`reqid`, `country`) VALUES (\"".$ip."\",\"".$reqid."\",\"".$country_ID."\");";
if (!($dbobj->query($dbcomm))) {
	die("<html><body><h1>INTERNAL SQL ERROR!</h1></body></html>\n");
}

// LOGGING REQUEST
$objdat = fopen('/membri/studyroompoli/logs/etf_review.txt', "a+");
fwrite($objdat, "REQUEST: ".$reqid."\n");
fwrite($objdat, "Course: ".$_GET['id']." - ".$jarr['name']."\n");
fwrite($objdat, "Content:\n".$_POST['txtdata']."\n");
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
$date = (new DateTime('NOW'))->format("Y-m-d");
$json_arr[$jt][]="[".$date."] ".$_POST['txtdata'];
$json_data=json_encode($json_arr);
file_put_contents($course_file,$json_data);
flock($f, LOCK_UN);
fclose($f);

// REDIRECT TO INFO PAGE
if(isset($_GET['en']))
	$redir= "info.php?id=".$_GET['id']."&en";
else
	$redir= "info.php?id=".$_GET['id'];
header('Location: '.$redir);
?>
