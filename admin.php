<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
		$page = 'admin';
		include 'header.php';
		include 'db.php';

		include 'dodavanjeKorisnika.php';
		$username = null;

		if(isset($_POST['usernameKorisnika']))
			$username = htmlEntities($_POST['usernameKorisnika'], ENT_QUOTES);
		
		if(isset($_POST['dodaj'])){
			$username = htmlEntities($_POST['username'], ENT_QUOTES);
			$naziv = htmlEntities($_POST['naziv'], ENT_QUOTES);
			$password = htmlEntities($_POST['password'], ENT_QUOTES);
			$postoji = dodajKorisnika($username, $naziv, $password);
		}

		if(isset($_POST['brisanje'])){
			obrisiAutora($username);
		}

		if(isset($_POST['edit'])){
			$naziv;
			if(isset($_POST['naziv'])){
				$naziv = htmlEntities($_POST['naziv'], ENT_QUOTES);
			}
			$stariUsername = htmlEntities($_POST['starUsername'], ENT_QUOTES);
			editujAutora($username, $naziv, $stariUsername);
		}

		print "<h3>Lista korisnika</h3>";

		if(isset($_POST['ponisti'])){
			ispisiAutore();
		}
		else ispisiAutore();
	?>
	<footer>
	</footer>
</body>