<!-- HEAD -->
<!DOCTYPE html>
<?php

// ENGLISH
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - THESIS EXPERIENCE";
	$msg['warn']="For security reasons, your IP will be marked on this site's database after adding a question.";
	$msg['butt']="Add";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - ESPERIENZA TESI";
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
echo "<p style=\"text-align: center;\">".$msg['warn']."</p>\n";
echo "<form action='submit.php";
if(isset($_GET['en'])) echo "?en";
echo "' method='post'>\n";
echo "TITLE:<br><input type='text' id='txttitle' name='txttitle' style='width:100%;'><hr>REVIEW:<br>";
echo "<div style='text-align:center;'><textarea name='txtdata' rows='5' style='width:100%;'></textarea>\n";
echo "<p><input type='submit' value='".$msg['butt']."'><br></p></div>\n";
echo "</form>\n";
?>
</div>

</body>
</html>
