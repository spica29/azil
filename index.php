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
		<!--<h2>Naslovnica</h2>

		<article class="vijest">
			<figure><img src="images/dog-and-puppy-adoption.jpg" alt="Adopt me"></figure>
			<h3>Usvajanje</h3>

			<div class="opisVremena"></div>
			<div class="vrijeme"> 2016/03/29 03:04:05 </div>
			
			<p>Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje.</p>
		</article>

		<article class="vijest">
			<figure><img src="images/dog-and-puppy-adoption.jpg" alt="Adopt me"></figure>
			<h3>Usvajanje</h3>

			<div class="opisVremena"></div>
			<div class="vrijeme"> 2016/03/19 03:04:05 </div>
			
			<p>Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje.</p>
		</article>

		<article class="vijest">
			<figure><img src="images/dog-and-puppy-adoption.jpg" alt="Adopt me"></figure>
			<h3>Usvajanje</h3>

			<div class="opisVremena"></div>
			<div class="vrijeme"> 2016/04/01 03:04:05 </div>
			
			<p>Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje.</p>
		</article>

		<article class="vijest">
			<figure><img src="images/dog-and-puppy-adoption.jpg" alt="Adopt me"></figure>
			<h3>Usvajanje</h3>

			<div class="opisVremena"></div>
			<div class="vrijeme"> 2016/04/02 03:04:05 </div>
			
			<p>Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje.</p>
		</article>-->
	</section>
	<footer>
	</footer>
</body>