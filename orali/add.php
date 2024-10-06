<?php $cssvers = file_get_contents("../style.inf"); ?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Area ETF</title>
	<meta charset="utf-8">
	<meta name="description" content="Area per il Collegio ETF PoliTO">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
	<style>
	form {
		margin: 0 auto;
		width: 90%;
		box-sizing: border-box;
		align-items: center;
	}
	textarea {
		width: 100%;
		height: 150px;
	}
	input[type="submit"] {
		display: block;
		margin: 0 auto;
	}
	</style>
</head>
<body>
<?php
$data_file="data/".$_GET['id']."/data.json";
$json_data=file_get_contents($data_file);
if(!$json_data) {
	die("<h1>ID NOT FOUND!</h1>\n</body>\n</html>\n");
}
$json_arr=json_decode($json_data,true);
if(!$json_arr['open']) {
	die("<h1>ID LOCKED!</h1>\n</body>\n</html>\n");
}
?>
<h1 style="text-align: center;">Area ETF - FOGLIO ORALI</h1>
<?php
echo "<h2 style=\"text-align: center;\">".$json_arr['title']." <span class='iscode'>[".$_GET['id']."]</span></h2>\n";
echo "<h3 style=\"text-align: center;\">Please, insert text, then press SUBMIT'</h3>\n";
echo "<form action='save.php?id=".$_GET['id']."' method='post'>\n";
echo "<p>\n";
echo "<textarea style='justify-contentcenter;' name='txtdata' rows='5'></textarea>\n";
echo "</p>\n";
echo "<input type='submit' value='SUBMIT'><br>\n";
echo "</form>\n";
?>

</body>
</html>
