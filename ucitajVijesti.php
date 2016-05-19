<?php
	//citanje csv-a
	$file = file("files/novosti.csv");
	foreach ($file as $r) {
		print "<article class='vijest'>
				<img src='images/dog-and-puppy-adoption.jpg' alt='Adopt me'/>
				<h3>";
		$c = explode(',', $r);
		print $c[0] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $c[4] . "</div>
		<p>" . $c[1] . "</p>
		</article>";
	}
?>
