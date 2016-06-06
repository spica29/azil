<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/contact.css">
</head>
<body>
	<footer>
		<?php 
			include 'loginfunc.php';
			$page = 'account';
			include 'header.php';

			if(isset($_POST['promijeni'])){
				$stariPW = $_POST['stariPW'];
				$noviPW1 = $_POST['noviPW1'];
				$noviPW2 = $_POST['noviPW2'];

				if(potvrdiPW($stariPW) && $noviPW1 == $noviPW2){
					promijeniPW($stariPW, $noviPW1);
				}
			}

			print "<h3>Promijeni password</h3>";
			print "<form action='account.php' id='forma' method='post'>";
				print "<label for='stariPW'>Stari password: </label>
				<input type='password' name='stariPW' id='stariPW' required>";
				print " <label for='noviPW1'>Novi password: </label>
				<input type='password' name='noviPW1' id='noviPW1' required>";
				print " <label for='noviPW2'>Potvrdi novi password: </label>
				<input type='password' name='noviPW2' id='noviPW2' required>";
				print "<input type='submit' name='promijeni' value='Promijeni password'>";
			print "</form>";
		?>
	</footer>
</body>