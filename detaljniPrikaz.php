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

		prikaziVijest($vijest, $autor);

		//komentari
		$korisnik = null; //korisnik nije logovan
		if(isset($_SESSION['username']))
			$korisnik = nadjiKorisnikaUsername(); // username

		//trazenje komentara za novost
		$idNovosti = $_GET['id'];
		//provjera je li dozvoljeno komentarisanje
		if(dozvoljenoKomentarisanje($idNovosti)){
			//dozvoljeno
			$komentari = nadjiKomentare($idNovosti);

			if($komentari != false)
				ispisivanjeKomentaraVijesti($komentari);	
			else {
				echo "Nema komentara";
			}

			formaZaUnosKomentara($korisnik);

		} else {
			echo "Nije dozvoljeno komentarisanje";
		}	

	?>
	
	<footer>
	</footer>
</body>