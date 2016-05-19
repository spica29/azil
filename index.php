<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Azil za životinje</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<!-- login -->
	<?php 
		include 'loginfunc.php';
		$page = 'index';
		include 'header.php';
	?>
	<nav id="vremenski">
		<ul>
			<li>
				<a href="#" onclick="return sve();">Svi</a>
			</li><li>
				<a href="#" onclick="return dnevni();">Dnevni</a>
			</li><li>
				<a href="#" onclick="return sedmicni();">Sedmični</a>
			</li><li>
				<a href="#" onclick="return mjesecni();">Mjesečni</a>
			</li>
		</ul>
	</nav>

	<section id="section">
		<?php include 'ucitajVijesti.php'; ?>
	</section>
	<footer>
	</footer>
</body>