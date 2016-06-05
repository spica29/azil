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

		//dodavanje komentara POST
		include 'komentar.php';
		$idVijesti = $_GET['id'];
		//postavljanje procitanih komentara
		postaviProcitaneKomentare($idVijesti);

		//ucitavanje stranice

		if(isset($_POST['obrisiVijest'])){
			obrisiVijest($idVijesti);
			//redirect
			header('Location: '.'index.php');
		}

		if(isset($_POST['obrisiKomentar'])){
			$komentar = $_POST['komentar_id'];
			//print "<script>console.log('komentar id: " . $komentar ."')</script>";
			obrisiKomentar($komentar);
		}

		if(isset($_POST['zabraniKomentarisanje'])){
			zabraniKomentarisanje($idVijesti);
		}

		if(isset($_POST['dozvoliKomentarisanje'])){
			dozvoliKomentarisanje($idVijesti);
		}

		$vijest = nadjiVijest($idVijesti);

		$autorID = nadjiAutoraVijesti($idVijesti);
		$autor = nadjiAutoraID($autorID);

		prikaziVijest($vijest, $autor, $idVijesti);

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

			formaZaUnosKomentara($korisnik, $idNovosti);

		} else {
			echo "Nije dozvoljeno komentarisanje";
		}	

	?>
	
	<footer>
	</footer>
</body>