<?php
	include 'loginfunc.php';
	include 'db.php';
	
	//include 'db.php';
	$autorID = nadjiAutora();
	$novosti = nadjiNovostiAutora($autorID);
	$suma = 0;
	foreach ($novosti as $novost) {
		$suma += brojNeprocitanih($novost['id']);
	}
	if($suma != 0) echo $suma;
?>