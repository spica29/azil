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

		if(isset($_POST['brisanje'])){
			$username = $_POST['username'];
			obrisiAutora($username);
		}

		if(isset($_POST['ponisti'])){
			ispisiAutore();
		}
		else ispisiAutore();
	?>
	<footer>
	</footer>
</body>