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
		if(isset($_SESSION['username']))
		{
			$page = 'login';
			header("Location: logout.php");
		} 
		$page = 'login';
		include 'header.php';	
	?>

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

	<!--Click here to clean <a href = "logout.php" tite = "Logout">Session.-->

	<footer>
	</footer>
</body>