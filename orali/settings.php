<?php
// SESSION & DB
session_start();
require("/membri/studyroompoli/cfg/sql.php");

// CONTROLLO LOGIN
if (!isset($_SESSION['loggedin'])) {
	header('Location: /idp/?id=/areaetf/orali/settings.php');
} else {
	// INTERROGAZIONE DATABASE
	$stmt = $dbobj->prepare('SELECT id, type FROM accounts WHERE username = ?');
	$stmt->bind_param('s',$_SESSION['name']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($user_name,$user_type);
	$stmt->fetch();
	$stmt->close();

	// LOGOUT ONLY
	echo "<h3>Logged as ".$_SESSION['name']." <a href='/idp/logout.php?id=/areaetf/orali/settings.php'>Logout</a>&nbsp";
	
}
?>
