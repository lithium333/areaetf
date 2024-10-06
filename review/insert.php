<!-- HEAD -->
<!DOCTYPE html>
<?php

// TRY OPENING DATA
$course_file="cont/".$_GET['id'].".json";
$course_fobj=fopen($course_file,"r");
if(!$course_fobj) {
	die("<html><body><h1>QUERY ERROR!</h1></body></html>\n");
}
$jdata=file_get_contents($course_file);
$jarr=json_decode($jdata,true);

// OPMODE CHECK
switch($_GET['mode']) {
	case "pro":
		$t="PRO";
		break;
	case "con":
		$t="CON";
		break;
	case "exm":
		$t="EXAM";
		break;
	default:
		die("<html><body><h1>QUERY ERROR!</h1></body></html>\n");
}

// ENGLISH
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - COURSE REVIEWS";
	$msg['warn']="For security reasons, your IP will be marked on this site's database after adding a question.";
	$msg['butt']="Add";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - RECENSIONI DEI CORSI";
	$msg['warn']="Per fini di sicurezza il tuo IP sarà segnato sul database di questo sito dopo l'aggiunta di una domanda.";
	$msg['butt']="Aggiungi";
}
$cssvers = file_get_contents("../style.inf");
?>

<head>
	<title><?php echo $msg['desc']; ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $msg['title']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
	<style>
	textarea {
		height: 70vh;
	}
	</style>
</head>


<body>
<div style="margin-left:5%;margin-right:5%">
<h1 style="text-align:center;"><?php echo $msg['desc']; ?></h1>
<?php
switch($jarr['lang']) {
	case "en":
		$lang_emoj="🇬🇧 ";
		break;
	case "it":
		$lang_emoj="🇮🇹 ";
		break;
	default:
		$lang_emoj="";
}

echo "<h2 style=\"text-align: center;\">(".$t.") ".$lang_emoj.htmlentities($jarr['name'])." <span class='iscode'>[".$_GET['id']."]</span></h2>\n";
echo "<p style=\"text-align: center;\">".$msg['warn']."</p>\n";
echo "<form action='submit.php?id=".$_GET['id']."&mode=".$_GET['mode'];
if(isset($_GET['en'])) echo "&en";
echo "' method='post'>\n";
echo "<div style='text-align:center;'><textarea name='txtdata' rows='5' style='width:100%;'></textarea>\n";
echo "<p><input type='submit' value='".$msg['butt']."'><br></p></div>\n";
echo "</form>\n";
?>
</div>

</body>
</html>
