<?php $cssvers = file_get_contents("../style.inf"); ?>
<html lang="it">

<head>
	<title>AREA ETF - FOGLI ORALI</title>
	<meta charset="utf-8">
	<meta name="description" content="Area per il Collegio ETF PoliTO">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
</head>

<body>
	<h1 style="text-align: center;">AREA ETF - FOGLI ORALI</h1>
	<div class='container_t'><b><a href='/areaetf' style="color:#FF0000;">MAIN MENU</a></b></div>
	<?php
	$jcont=file_get_contents("data.json");
	$jdata=json_decode($jcont,true);
	foreach ($jdata as $jkey => $jval) {
		$data_file2="data/".$jkey."/data.json";
		$json_data2=file_get_contents($data_file2);
		$json_obj2=json_decode($json_data2,true);
		echo "<div class='container_t'><a href='view.php?id=".$jkey."'>".$json_obj2['title']."</a></div>\n";
	}
	?>
</body>

</html>
