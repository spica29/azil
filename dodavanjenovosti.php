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
			$err = "";

			$naslov = htmlEntities($_POST['naslov'], ENT_QUOTES);
 			$opis = htmlEntities($_POST['opis'], ENT_QUOTES);
 			$kodDrzave = htmlEntities($_POST['kodDrzave'], ENT_QUOTES);
 			$brojTel = htmlEntities($_POST['brojTel'], ENT_QUOTES);
 			$datum = date("Y/m/d H:i:s");
 			$datum = strval($datum);
 			$urlSlike = htmlEntities($_POST['slika'], ENT_QUOTES);
 			$selected_radio = $_POST['komentaridoz'];
 			$dozvoljeniKomentari;
 			if($selected_radio == "DA")
 				$dozvoljeniKomentari = 1;
 			else $dozvoljeniKomentari = 0;

			if ($naslov == "" || $opis == "" || $kodDrzave == "" || $brojTel == ""){
  				$err = "prazna polja";
  			}
			else {
				//unos u bazu
				include 'db.php';
				unosVijesti($naslov, $opis, $datum, $urlSlike, $dozvoljeniKomentari);
			} 
			if($err != "") echo $err;
		}	
	?>

	<form id="kontakt-forma" method="POST" action="dodavanjenovosti.php" onsubmit="return validirajPolja();">
		<label for="naslov">Naslov vijesti: </label>
		<input type="text" name="naslov" id="naslov" onkeyup="validirajNaslov(this)" required>
		<br>
		<label for="slika">Url slike: </label>
		<input type="text" name="slika" id="slika" required>
		<br>
		<label for="kodDrzave">Dvoslovni kod drzave: </label>
		<input type="text" name="kodDrzave" id="kodDrzave" onkeyup="validirajDrzavu(this)" required>
		<br>
		<label for="brojTel">Broj telefona (sa pozivnim): </label>
		<input type="tel" name="brojTel" id="brojTel" onkeyup="validirajKod(this)" required>
		<br>
		<div id="drzava"> Komentarisanje dozvoljeno:
			<input type="radio" id="drzava1" name="komentaridoz" value="DA" checked> DA
			<input type="radio" id="drzava2" name="komentaridoz" value="NE"> NE
		</div><br><br>
		<label for="opis">Tekst vijesti: </label>
		<textarea name="opis" id="opis" cols="60" rows="10" required></textarea>
		<br>
		<input type="submit" name="dodajNovost" value="Pošalji">
	</form>
	<footer>
	</footer>
</body>