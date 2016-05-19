<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/contact.css">
	<script type="text/javascript" src="js/dodavanjenovosti.js"></script>
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
		if(!isset($_SESSION['username'])) {
			header("Location:Login.php");
			//print "<h1>Morate se logirati da biste vidjeli ovu stranicu </h1>";
		}
		$page = 'dodavanjenovosti';
		include 'header.php';

		if(isset($_POST['dodajNovost'])) {
			$naslov = htmlEntities($_POST['naslov'], ENT_QUOTES);
			$opis = htmlEntities($_POST['opis'], ENT_QUOTES);
			$kodDrzave = htmlEntities($_POST['kodDrzave'], ENT_QUOTES);
			$brojTel = htmlEntities($_POST['brojTel'], ENT_QUOTES);
			$datum = date("d.m.Y");
			$vrijeme = date("H:i:s");

			$redovi = file('files/novosti.csv');
			$sadrzaj = $naslov . ',' . $opis . ',' . $kodDrzave . ',' . $brojTel . ',' . $datum . ',' . $vrijeme . "\n";

			file_put_contents('files/novosti.csv', $sadrzaj, FILE_APPEND);
		}
	?>

	<form id="kontakt-forma" method="POST" action="dodavanjenovosti.php">
		<label for="naslov">Naslov vijesti: </label>
		<input type="text" name="naslov" id="naslov" onkeyup="validirajNaslov(this)" required>
		<br>
		<label for="opis">Tekst vijesti: </label>
		<input type="text" name="opis" id="opis" onkeyup="validirajOpis(this)" required>
		<br>
		<!-- zasad nema unos slike jer se ne moze drzati u csv-u -->
		<label for="kodDrzave">Dvoslovni kod drzave: </label>
		<input type="text" name="kodDrzave" id="kodDrzave" onkeyup="validirajDrzavu(this)" required>
		<br>
		<label for="brojTel">Broj telefona (sa pozivnim): </label>
		<input type="tel" name="brojTel" id="brojTel" onkeyup="validirajKod(this)" required>
		<br>
		<input type="submit" name="dodajNovost" value="Pošalji">
	</form>
	<footer>
	</footer>
</body>