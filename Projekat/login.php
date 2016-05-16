<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
	?>

	<div class="wrap">
		<div class="pad"></div>
		<div class="base-left"></div>
        <div class="base-right"></div>
        <div class="base-left-2"></div>
        <div class="base-right-2"></div>
        <div class="toe-1"></div>
        <div class="toe-2"></div>
        <div class="toe-3"></div>
        <div class="toe-4"></div>
	</div>
	
	<header><h1>Azil za životinje - ŠAPA</h1></header><br>
	
	<nav>
		<ul>
			<li><b><a href="index.php">NASLOVNICA</a></b></li>
			<li><b><a href="usvoji.php">USVOJI</a></b></li>
			<li><b><a href="postanifoster.php">POSTANI FOSTER</a></b></li>
			<li><b><a href="oazilu.php">O AZILU</a></b></li>
			<li><b><a href="contact.php">KONTAKT</a></b></li>
			<li><b><a class="active" href="login.php">LOGIN</a></b></li>
		</ul>
	</nav>

	<section>
		<!-- login -->
		<form id="kontakt-forma" method="post" action="login.php">
			<label for="username">Username: </label>	
			<input type="text" name="username" id="username">
			<br><label for="pw">Password: </label>	
			<input type="password" name="password" id="password">
			<br>
			<input type="submit" name="login" value="Prijavi se">
		</form>
	</section>

	Click here to clean <a href = "logout.php" tite = "Logout">Session.

	<footer>
	</footer>
</body>