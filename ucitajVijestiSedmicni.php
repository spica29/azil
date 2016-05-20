<?php
	//citanje csv-a
	$file = file("files/novosti.csv");
	$currentDate = date("Y/m/d H:i:s");
	$dayOfTheWeek = date('N', strtotime($currentDate));
	$day = date('d', strtotime($currentDate));
	foreach ($file as $r) {
		$c = explode(',', $r);
		$cDayOfTheWeek = date('N', strtotime($c[4]));
		$cDay = date('d', strtotime($c[4]));
		$razlikaUDanima = $day - $cDay;
		//print "<p> dan " . $day . " danusedmici " . $dayOfTheWeek . " cdan " . $cDay . " cdanusedm " . $cDayOfTheWeek . " razlika: " . $razlikaUDanima . "</p>"; 
		if($dayOfTheWeek - $cDayOfTheWeek < 7 && $dayOfTheWeek - $cDayOfTheWeek >= 0 && $razlikaUDanima < 7 && $razlikaUDanima >= 0)
		{
			print "<article class='vijest'>
				<img src='images/dog-and-puppy-adoption.jpg' alt='Adopt me'/>
				<h3>";
			print $c[0] . "</h3>
			<div class='opisVremena'></div>
			<div class='vrijeme'>" . $c[4] . "</div>
			<p>" . $c[1] . "</p>
			</article>";
		}			
	}
?>