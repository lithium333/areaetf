<!DOCTYPE html>
<?php
if(isset($_GET['en'])) {
	echo "<html lang=\"en\">\n";
	$msg['title']="PoliTO ETF college area";
	$msg['desc']="Services for ETF college in a single website";
	$msg['data']=["ORAL SHEETS",
	"COURSE REVIEWS",
	"GROUPS",
	"THESIS EXPERIENCE",
	"JOB EXPERIENCE"
	];
	$msg['linketf']="https://www.polito.it/en/polito/about-us/structures/collegi-dei-corsi-di-studio/collegio-di-ingegneria-elettronica-delle-telecomunicazioni-e";
} else {
	echo "<html lang=\"it\">\n";
	$msg['title']="Area per il Collegio ETF PoliTO";
	$msg['desc']="I servizi per il collegio ETF in un sito";
	$msg['data']=["FOGLI ORALI",
	"RECENSIONI CORSI",
	"GRUPPI",
	"ESPERIENZA TESI",
	"ESPERIENZA LAVORO",
	];
	$msg['linketf']="https://www.polito.it/ateneo/chi-siamo/strutture/collegi-dei-corsi-di-studio/collegio-di-ingegneria-elettronica-delle-telecomunicazioni-e";
}
$cssvers = file_get_contents("style.inf");
?>
<head>
	<title>AREA ETF</title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $msg['title']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/areaetf/style.css?v=<?php echo $cssvers; ?>">
</head>

<body>
	<h1 style="font-size:8vw;display:flex;text-align:center; color:#27665A;align-items:center;margin-bottom:2vh;margin-top:2vh;justify-content:center;">
	<img src='logo.svg' width='12%'>&nbsp;AREA&nbsp;ETF
	</h1>
	<h2 id="txtsplash" style="font-size:3vh;text-align:center;margin-left:5%;width:90%;margin-bottom:2vh;margin-top:2vh;"></h2>
	<script type="text/javascript">

	async function mysleep(msec) {
	    return new Promise(resolve => setTimeout(resolve, msec));
	}
	async function showtext() {
		msg = "<?php echo $msg['desc']; ?>!";
		for (let i=0;i<msg.length;i++) {
			document.getElementById('txtsplash').innerHTML+=msg[i];
			await mysleep(50);
		}
	}
	showtext();
	</script>
	<div class='container_t'><a href='groups<?php if(isset($_GET['en'])) echo "?en";?>'><?php echo $msg['data'][2]; ?></a></div>
	<div class='container_t'><a href='orali<?php if(isset($_GET['en'])) echo "?en";?>'><?php echo $msg['data'][0]; ?></a></div>
	<div class='container_t'><a href='review<?php if(isset($_GET['en'])) echo "?en";?>'><?php echo $msg['data'][1]; ?></a></div>
	<div class='container_t'><a href='tesi<?php if(isset($_GET['en'])) echo "?en";?>'><?php echo $msg['data'][3]; ?></a></div>
	<div class='container_t'><a href='job<?php if(isset($_GET['en'])) echo "?en";?>'><?php echo $msg['data'][4]; ?></a></div>
	<div class='container_t'><a href='orient' target='_blank'>QUIZ ORIENT. (ONLY ITA)</a></div>
	<div class='container_t'><a href='https://github.com/lithium333/areaetf' target='_blank'>SOURCE CODE</a></div>
</body>

</html>
