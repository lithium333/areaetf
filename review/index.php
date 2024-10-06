<!DOCTYPE html>
<?php
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
	<h1 style="text-align: center;"><?php echo $msg['desc']; ?></h1>
	<div class='container_t'><b><a style="color:#FF0000;" href='/areaetf'>MAIN MENU</a></b></div>
	<?php
	$jcont=file_get_contents("data.json");
	$jdata=json_decode($jcont,true);
	foreach ($jdata as $jkey => $jval) {
		echo "<div class='container_t'><a href='list.php?id=".$jkey;
		if(isset($_GET['en'])) echo "&en";
		echo "'>".$jval["title"]."</a></div>\n";
	}
	?>
</body>

</html>
