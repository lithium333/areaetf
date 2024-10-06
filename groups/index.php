<!DOCTYPE html>
<?php
if(isset($_GET["id"])) {
	$fname="data/".$_GET["id"].".json";
	if (!file_exists($fname)) {
		die("<html><h1>QUERY ERROR!</h1></html>");
	}
} else {
	$fname="cfg.json";
}
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="AREA ETF - GROUPS";
	$msg['grad']=["BS","MS"];
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="AREA ETF - GRUPPI";
	$msg['grad']=["L3","LM"];
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
	<div class='container_t'><b><a style="text-decoration: none; color:#FF0000;" href='/areaetf<?php if(isset($_GET['en'])) echo "?en"; ?>'>MAIN MENU</a></b></div>
	<?php
	if($_GET["id"]) {
		echo "<div class='container_t'><b><a style=\"text-decoration: none; color:#003F7F;\" href='/areaetf/groups";
		if(isset($_GET['en'])) echo "?en";
		echo "'>ALL ETF GROUPS</a></b></div>\n";
		}
	$jcont=file_get_contents($fname);
	$jdata=json_decode($jcont,true);
	foreach ($jdata as $jkey => $jval) {
		// check if separator
		if($jval["type"]=="S") {
			echo "<div class='container_t' style='background-color: transparent;border: 0;padding: 5px;'>".htmlentities($jval["name"])."</div>\n";
		} else if($jval["type"]=="G") {
			if($jval["link"][0]=="?") { // is category
				echo "<div class='container_t'>📂&nbsp;<a href='".$jval["link"];
				if(isset($_GET['en']))
					echo "&en";
				echo "'>".htmlentities($jval["name"])."</a></div>\n";
			} else {
				echo "<div class='container_t'>👥&nbsp;<a href='".$jval["link"]."' target='_blank'>".htmlentities($jval["name"])."</a></div>\n";
			}
		} else if($jval["type"]=="T") {
			echo "<h2 style=\"text-align: center;color:darkorange;\">sub: ".$jval["name"]."</h2>\n";
		}
	}
	?>
</body>

</html>
