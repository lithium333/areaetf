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

// ENGLISH
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - COURSE REVIEWS";
	$msg['data']=["Pros","Cons","Add new one","Exam suggestion"];
	$msg['stat1']="For exam statistics";
	$msg['stat2']="Visit the official page (IT)";
	$msg['help1']="Hint: For any other information";
	$msg['help2']="Visit the official teaching guide";
	$msg['del']="Deleted comment";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - RECENSIONI DEI CORSI";
	$msg['data']=["Pro","Contro","Aggiungine uno","Suggerimenti esame"];
	$msg['stat1']="Per le statistiche sugli esami";
	$msg['stat2']="Visitare la relativa pagina ufficiale";
	$msg['help1']="NB: Per ogni altra informazione";
	$msg['help2']="Visitare la guida ufficiale dell'insegnamento";
	$msg['del']="Questo commento è stato eliminato";
}
$cssvers = file_get_contents("../style.inf");
?>

<head>
	<title><?php echo htmlentities($jarr['name']); ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $msg['title']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
</head>

<body>
<div style="margin-left:5%;margin-right:5%;margin-bottom:3%;">
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
echo "<h2 style=\"text-align: center;\">".$lang_emoj.htmlentities($jarr['name'])." <span class='iscode'>[".$_GET['id']."]</span></h2>\n";
fclose($course_fobj);
echo "<h3 style=\"text-align: center;\">\n";
echo "<a style=\"text-decoration: underline; color:#007F00;\" href='#exam'>SUGGERIMENTI ESAME</a><br>\n";
echo "<a style=\"text-decoration: underline; color:#007F00;\" href='#cons'>CONTRO</a>\n";
echo "<a style=\"text-decoration: underline; color:#007F00;\" href='#pro'>PRO</a>\n";
echo "<a style=\"text-decoration: underline; color:#FF0000;\" href='/areaetf'>MAIN MENU</a>\n";
echo "</b></h3>\n";

echo "<hr>\n";

// LIST EXAM
echo "<a name='exam'></a>\n";
echo "<h2 style=\"color:#7F00FF;\">".$msg['data'][3].":</h2>\n";
$i=1;
foreach ($jarr['exm'] as $jitem) {
	if($jitem==null) {
		echo "<h3><span class='isitem'>".$i.":</span> "."<span class='isdeleted'><i>".htmlentities($msg['del'])."</i>"."</span></h3>\n";
	} else {
		$jitem_r=str_replace("\n", "<br>",htmlentities($jitem));
		echo "<h3><span class='isitem'>".$i.":</span> ".$jitem_r."</h3>\n";
	}
	$i++;
}
echo "<h3><span class='isitem'>+:</span> <a style='text-decoration: underline;' href='insert.php?mode=exm&id=".$_GET['id'];
if(isset($_GET['en'])) echo "&en";
echo "'>".$msg['data'][2]."</a></h3>\n";

echo "<hr>\n";

// LIST CONTRO
echo "<a name='cons'></a>\n";
echo "<h2 style=\"color:#960018;\">".$msg['data'][1].":</h2>\n";
$i=1;
foreach ($jarr['not'] as $jitem) {
	if($jitem==null) {
		echo "<h3><span class='isitem'>".$i.":</span> "."<span class='isdeleted'><i>".htmlentities($msg['del'])."</i>"."</span></h3>\n";
	} else {
		$jitem_r=str_replace("\n", "<br>",htmlentities($jitem));
		echo "<h3><span class='isitem'>".$i.":</span> ".$jitem_r."</h3>\n";
	}
	$i++;
}
echo "<h3><span class='isitem'>+:</span> <a style='text-decoration: underline;' href='insert.php?mode=con&id=".$_GET['id'];
if(isset($_GET['en'])) echo "&en";
echo "'>".$msg['data'][2]."</a></h3>\n";

echo "<hr>\n";

// LIST PRO
echo "<a name='pro'></a>\n";
echo "<h2 style=\"color:green;\">".$msg['data'][0].":</h2>\n";
$i=1;
foreach ($jarr['pro'] as $jitem) {
	if($jitem==null) {
		echo "<h3><span class='isitem'>".$i.":</span> "."<span class='isdeleted'><i>".htmlentities($msg['del'])."</i>"."</span></h3>\n";
	} else {
		$jitem_r=str_replace("\n", "<br>",htmlentities($jitem));
		echo "<h3><span class='isitem'>".$i.":</span> ".$jitem_r."</h3>\n";
	}
	$i++;
}
echo "<h3><span class='isitem'>+:</span> <a style='text-decoration: underline;' href='insert.php?mode=pro&id=".$_GET['id'];
if(isset($_GET['en'])) echo "&en";
echo "'>".$msg['data'][2]."</a></h3>\n";

echo "<hr>\n";

// OFFICIAL LINKS
echo "<h2 style=\"color:darkblue;\">".$msg['stat1'].":</h2>\n";
echo "<a style='text-decoration: underline;' href='https://didattica.polito.it/pls/portal30/esami.superi.grafico?p_cod_ins=".$_GET['id']."' target='_blank'>";
echo $msg['stat2']."</a>\n";
echo "<h2 style=\"color:darkblue;\">".$msg['help1'].":</h2>\n";
echo "<a style='text-decoration: underline;' href='https://didattica.polito.it/pls/portal30/gap.pkg_guide.viewGap?p_cod_ins=".$_GET['id']."' target='_blank'>";
echo $msg['help2']."</a>\n";
?>
</div>

<!-- TAIL -->
</body>

</html>
