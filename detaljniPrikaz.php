<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/detaljniPrikaz.css">
	<script type="text/javascript" src="js/detaljniPrikaz.js"></script>
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
		$page = 'index';
		include 'header.php';
		include 'db.php';

		$idVijesti = $_REQUEST["id"];
		$vijest = nadjiVijest($idVijesti);

		$autorID = nadjiAutoraVijesti($idVijesti);
		$autor = nadjiAutoraID($autorID);

		print "<article class='vijest'>
				<img src='" . $vijest['urlslike'] . "' alt='slika'/>
				<h3>";
		print $vijest['naslov'] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $vijest['vrijeme'] . "</div>";
		//prikaz autora
		print "<h4 id='autor'>Autor: <a href='index.php?autor=" . $autor['id'] . "'>" . $autor['naziv'] . "</a></h4>";
		print "<p>" . $vijest['opis'];
		print "</p></article>";

		$korisnik = "Amela"; // username
		$tekstKomentara = "Predivno je zaista";
		//ispisivanje komentara
		print "<section id='komentari'>";
			print "<h3>Komentari:</h3>";
			print "<article id='komentar'>";
				print "Korisnik: " . $korisnik;
				print "<br>Komentar: " . $tekstKomentara;
			print "</article>";
			print "<article id='komentar'>";
				print "Korisnik: " . $korisnik;
				print "<br>Komentar: " . $tekstKomentara;
			print "</article>";
			print "<article id='komentar'>";
				print "Korisnik: " . $korisnik;
				print "<br>Komentar: " . $tekstKomentara;
			print "</article>";
		print "</section>";
	?>
	
	<footer>
	</footer>
</body>