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
		$page = 'login';
		include 'header.php';

		if(isset($_POST['logout'])){
			unset($_SESSION["username"]);
			unset($_SESSION["password"]);

			//echo 'You have cleaned session';
			header('Location: login.php');
		}
	?>

	<section>
		<!-- login -->
		<form id="kontakt-forma" method="post" action="logout.php">
			<label for="username">Vec ste logovani kao korisnik: <?php print $_SESSION['username'] ?> </label>	
			<br>
			<input type="submit" name="logout" value="Log out">
		</form>
	</section>

	<!--Click here to clean <a href = "logout.php" tite = "Logout">Session.-->

	<footer>
	</footer>
</body>

