<!DOCTYPE html>
<?php

// TRY OPENING DATA
$jdata=file_get_contents("data.json");
$jarr=json_decode($jdata,true);

// ENGLISH
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - THESIS EXPERIENCE";
	$msg['data']=["Comments","Add new one"];
	$msg['del']="Deleted comment";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - ESPERIENZA TESI";
	$msg['data']=["Commenti","Aggiungine uno"];
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
echo "<h3 style=\"text-align: center;\">\n";
echo "<a style=\"text-decoration: underline; color:#FF0000;\" href='/areaetf'>MAIN MENU</a>\n";
echo "</b></h3>\n";

echo "<hr>\n";

// LIST EXP
echo "<h2 style=\"color:green;\">".$msg['data'][0].":</h2>\n";
$i=1;
foreach ($jarr as $jitem) {
	if($jitem['data']==null) {
		echo "<h3><span class='isitem'>".$i.":</span> "."<span class='isdeleted'><i>".htmlentities($msg['del'])."</i>"."</span></h3>\n";
	} else {
		$jitem_r=str_replace("\n", "<br>",htmlentities($jitem['data']));
		echo "<h3><span class='isitem'>".$i."</span> <b>".$jitem['title']."</b>:<br>".$jitem_r."</h3>\n";
	}
	$i++;
}
echo "<h3><span class='isitem'>+:</span> <a style='text-decoration: underline;' href='insert.php";
if(isset($_GET['en'])) echo "?en";
echo "'>".$msg['data'][1]."</a></h3>\n";
?>
</div>

<!-- TAIL -->
</body>

</html>
