<!DOCTYPE html>
<?php
require("/membri/studyroompoli/cfg/sql.php");
// TRY OPENING INFO
$jcont=file_get_contents("data.json");
$jdata=json_decode($jcont,true);
$course=$_GET['id'];
if(!isset($jdata[$course]))
	die("<html><body><h1>QUERY ERROR!</h1></body></html>\n");
// ENGLISH
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - COURSE REVIEWS";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - RECENSIONI DEI CORSI";
}
$cssvers = file_get_contents("../style.inf");
?>

<head>
	<title><?php echo $msg['desc']; ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $msg['title']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
</head>

<body>
	<h1 style="text-align:center;"><?php echo $msg['desc']; ?></h1>
	<h2 style="text-align:center"><?php
	if(isset($_GET['en']))
		echo "Course: ";
	else
		echo "Corso: ";
	echo htmlentities($jdata[$course]["title"]);
	?></h2>
	<?php
	$jcont=file_get_contents("data_".$course.".json");
	$jdata=json_decode($jcont,true);
	//titoli
	echo "<div class='container'><h3 style='text-align:center;'>GOTO:</h3>\n";
	echo "<div class='container_t'><b><a href='/areaetf'>MAIN MENU</a></b></div>\n";
	foreach ($jdata as $jkey => $jval) {
		echo "<div class='container_t'><a href='#".$jkey."'>".htmlentities($jval["name"])."</a></div>\n";
	}
	echo "</div>\n";
	//elenchi
	foreach ($jdata as $jkey => $jval) {
		// pre-elaborazione
		$lsunsort=[];
		foreach ($jval['corsi'] as $jval2) {
			if($jval2[0]=='#') {
				$lsunsort[$jval2]="\x7f";
			} else {
				$jdata=file_get_contents("cont/".$jval2.".json");
				$jvect=json_decode($jdata,true);
				if($jvect==null) {
					$lsunsort[$jval2]="NOT FOUND!";
				} else {
					$lsunsort[$jval2]=$jvect["name"];
				}
			}
		}
		asort($lsunsort);
		// mostra
		echo "<a id='".$jkey."'></a>\n";
		echo "<div class='container'><h3 style='text-align:center;'>".htmlentities($jval["name"])."</h3>\n";
		foreach ($lsunsort as $jkey2 => $jval2) {
			if($jkey2[0]=='#') {
				echo "<div class='container_t'><a href='".$jkey2."'>".$jkey2."</a></div>\n";
			} else {
				echo "<div class='container_t'><a href='info.php?id=".$jkey2;
				if(isset($_GET['en'])) echo "&en";
				echo "'>".htmlentities($jval2)."</a></div>\n";
			}
		}
		echo "</div>\n";
	}
	?>
</body>

</html>
