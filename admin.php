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

		$username = null;

		if(isset($_POST['usernameKorisnika']))
			$username = $_POST['usernameKorisnika'];
		
		if(isset($_POST['brisanje'])){
			obrisiAutora($username);
		}

		if(isset($_POST['edit'])){
			$naziv;
			if(isset($_POST['naziv'])){
				$naziv = $_POST['naziv'];
			}
			$stariUsername = $_POST['starUsername'];
			editujAutora($username, $naziv, $stariUsername);
		}

		if(isset($_POST['ponisti'])){
			ispisiAutore();
		}
		else ispisiAutore();
	?>
	<footer>
	</footer>
</body>