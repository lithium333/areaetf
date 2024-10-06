<?php $cssvers = file_get_contents("../style.inf"); ?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Area ETF</title>
	<meta charset="utf-8">
	<meta name="description" content="Area per il Collegio ETF PoliTO">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
</head>
<body>
<div style="margin-left:5%;margin-right:5%">
<?php
$data_file="data/".$_GET['id']."/data.json";
$json_data=file_get_contents($data_file);
if(!$json_data) {
	die("<h1>ID NOT FOUND!</h1>\n</body>\n</html>\n");
}
$json_arr=json_decode($json_data,true);
?>
<h1 style="text-align: center;">Area ETF - FOGLIO ORALI</h1>
<?php
echo "<h2 style=\"text-align: center;\">".$json_arr['title']." <span class='iscode'>[".$_GET['id']."] ";
if($json_arr['open'])
	echo "<span class='isopen'>(OPEN";
else
	echo "<span class='islocked'>(LOCKED";
echo ")</span></h2>\n";
echo "<h3 style=\"text-align: center;\"><b><a style=\"text-decoration: none; color:#FF0000;\" href='/areaetf'>MAIN MENU</a></b></h3>";
$i=1;
foreach ($json_arr['domande'] as $jdata) {
	$jdata_r=str_replace("\n", "<br>",htmlentities($jdata));
	echo "<h3><span class='isitem'>".$i.":</span><br>".$jdata_r."</h3>\n";
	$i++;
}
if($json_arr['open']) {
	echo "<h3><span class='isitem'>➕ </span> <a href='add.php?id=".$_GET['id']."'>Add item</a></h3>\n";
}
echo "<h3><span class='isitem'>⬇️ </span> <a href='download.php?id=".$_GET['id']."'>Download as .txt</a></h3>\n";
echo "<h3><span class='isitem'>⬇️ </span> <a href='download.php?id=".$_GET['id']."&json'>Download .json DB</a></h3>\n";
?>
</div>

<!-- TAIL -->
</body>
</html>
