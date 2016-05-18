<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/contact.css">
	<script type="text/javascript" src="js/contact.js"></script>
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
		$page = 'contact';
		include 'header.php';
	?>

	<form id="kontakt-forma">	
		<label for="name">Ime i prezime: </label>
		<input type="text" name="name" id="name" onkeyup="validirajIme(this)" required>
		<br>
		<label for="email">Email: </label>
		<input type="email" name="mail" id="email" onkeyup="validirajEmail(this)" required>
		<br><br>
		<div id="drzava">
			<input type="radio" id="drzava1" onclick="val_drzava()" name="drzavaa" value="Bosna i Hercegovina" checked> Bosna i Hercegovina
			<input type="radio" id="drzava2" onclick="val_drzava()" name="drzavaa" value="Srbija"> Srbija
			<input type="radio" id="drzava3" onclick="val_drzava()" name="drzavaa" value="Hrvatska">Hrvatska
		</div><br><br>
		<label for="brojTel">Broj telefona (sa pozivnim): </label>
		<input type="tel" name="brojTel" id="brojTel" onkeyup="validirajTel(this)" required>
		<label for="poruka">Poruka: </label>
		<textarea name="poruka" id="poruka" cols="60" rows="10" required></textarea>
		<br>
		<input type="submit" value="Pošalji">
	</form>

</body>