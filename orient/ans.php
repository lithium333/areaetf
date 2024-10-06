<html>
<head>
	<meta charset="utf-8">
	<title>Magistrale elettronica</title>
	<link rel="icon" href="/elt/media/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/elt/media/fav_main.ico" type="image/x-icon" />
	<meta property="og:title" content="Magistrale elettronica QUIZ" />
	<meta property="og:url" content="https://studyroompoli.altervista.org/elt/master/" />
	<meta property="og:type" content="website" />
	<style>
		table {
			margin-left: 10%;
			margin-right: 10%;
		}
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th,td {
			background-color: #BBFFBB;
			text-align: center;
		}
	</style>
</head>
<body>
<body>
<center>
	<h1>QUIZ: Qual è la magistrale che più fa per te?<br></h1>
	<h2><font color="darkblue">Gli indici di affinità da -1 a 1 sono:</font></h2>
</center>

<?php

/* LOAD JSON */
$jdata = file_get_contents("table.json");
$jarray = json_decode($jdata,true);

/* KEYS MATERIE */
$klist=["chim","fis1","fis2","alg","inf","disp","tds","appl","emf","esd","ctrl"];

/* FUNZIONE COLORE */
function getColor($val) {
	if($val<(-0.5)) {
		return 'red';
	} else if($val<(-0.25)) {
		return 'darkorange';
	} else if($val<(-0.125)) {
		return 'gold';
	} else if($val<0.125) {
		return 'gray';
	} else if($val<0.25) {
		return 'greenyellow';
	}else if($val<0.5) {
		return 'limegreen';
	} else {
		return 'green';
	}
}

/* CALCOLO AFFINITA */
echo "<h3 style='margin-left: 10%;margin-right: 10%'>\n";
foreach($jarray as $jkey => $jcont) {
	$parr[$jkey]=0; // punteggio usr
	$carr[$jkey]=0; // punteggio max
	foreach($klist as $subkey) {
		if($jcont["coeff"][$subkey]!=0) {
			$parr[$jkey]+=$_GET[$subkey]*$jcont["coeff"][$subkey];
			$carr[$jkey]+=$jcont["coeff"][$subkey];
		}	
	}
	$color=getColor($parr[$jkey]/$carr[$jkey]);
	if ($jcont["iselt"]==0)
		echo "<font color='blue'>";
	else
		echo "<font color='black'>";
	echo $jcont["name"]."</font> : <font color='".$color."'><b>".number_format($parr[$jkey]/$carr[$jkey], 2, '.', '')."</b></font><br>";
}
echo "</h3>\n";
?>

<center><h2><font color="darkblue">Interpretare i risultati:</font></h2></center>

<h3 style="margin-left: 10%;margin-right: 10%"><font color='darkorange'>Attenzione #1: i seguenti risultati non sono da interpretare alla lettera! L'autore del quiz non si assume alcuna responsabilità per scelte errate legate all'uso di esso, si consiglia sempre di affidarsi a dei percorsi di orientamento per la scelta della magistrale!</font></h3>

<h3 style="margin-left: 10%;margin-right: 10%"><font color='darkorange'>Attenzione #2: i valori che escono fuori da questo quiz devono essere interpretati con buon senso: non basta prendere il numero più positivo e scegliere quella magistrale: un 0.67 può valere quanto un 1 in quanto piccole differenze a parità di affinità possono esserci in quanto questo test, come tutti, è soggetto a dei bias durante la risposta alle domande.</font></h3>

<center><h2><font color="darkblue">Legenda:</font></h2></center>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='red'>█</font> da -1 a -0.5 : quasi sicuramente non fa per te.<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='darkorange'>█</font> da -0.5 a -0.25 : c'è scarsa probabilità che possa entusiasmarti.<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='gold'>█</font> da -0.25 a -0.125 : non sembra interessarti tanto, consulta l'orientamento per essere sicur*.<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='gray'>█</font> da -0.125 a 0.125 : il quiz non è sufficiente a rispondere per questa magistrale, consulta l'orientamento!<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='greenyellow'>█</font> da 0.125 a 0.25 : sembra interessarti, ma qualche materia potrebbe non fartela apprezzare, consulta l'orientamento per essere sicur*.<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='limegreen'>█</font> da 0.25 a 0.5 : c'è molta probabilità che ti piaccia.<br>
</h3>
<h3 style="margin-left: 10%;margin-right: 10%">
<font color='green'>█</font> da 0.5 a 1 : quasi sicuramente è la tua scelta, approfondisci chiedendo informazioni a chi è del corso!<br>
</h3>

<center><h2><font color="darkblue">Per saperne di più:</font></h2></center>


<table>
<tr>
	<td></td>
	<th>Chimica</th>
	<th>Fisica 1</th>
	<th>Algebra</th>
	<th>Informatica</th>
	<th>Fisica 2</th>
	<th>Dispositivi</th>
	<th>Segnali/Comunicazioni</th>
	<th>Applicata</th>
	<th>Campi</th>
	<th>Digitale</th>
	<th>Controlli</th>
</tr>
<?php
foreach($jarray as $jkey => $jcont) {
	echo "<tr>";
	echo "<th>".$jcont["name"]."</th>";
	foreach($klist as $subkey) {
		switch($jcont["coeff"][$subkey]) {
		case 1:
			echo "<td style='color:#FF7F00'>".$jcont["coeff"][$subkey]."</td>";
			break;
		case 2:
			echo "<td style='color:#FF0000'>".$jcont["coeff"][$subkey]."</td>";
			break;
		default:
			echo "<td>".$jcont["coeff"][$subkey]."</td>";
		}
	}
	echo "</tr>\n";
}
?>
</table>

<h3 style="margin-left: 10%;margin-right: 10%">
Regola di calcolo: indice=somma(Cij*Rj)/somma(Cij)<br>
dove Cij è la correlazione tra magistrale <b>i</b> e materia <b>j</b>, Rj la risposta al gradimento della materia <b>j</b><br>
(Cij: 0 scorrelate, 1 leggermente correlate, 2 molto correlate)<br>
(Rj: -1 per niente, -0.5 poco, 0 neutro, 0.5 abbastanza, 1.0 tantissimo)<br>
</h3>

<center>↩️ <a href='https://studyroompoli.altervista.org/elt/'>Home Elettronica Triennale</a></center>
</body>
</html>
