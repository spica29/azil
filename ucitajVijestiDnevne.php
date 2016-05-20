<?php
	//citanje csv-a
	$file = file("files/novosti.csv");
	$currentDate = date("Y/m/d H:i:s");
	$year = date('y', strtotime($currentDate));
	$month = date('m', strtotime($currentDate));
	$day = date('d', strtotime($currentDate));
	foreach ($file as $r) {
		$c = explode(',', $r);
		$cYear = date('y', strtotime($c[4]));
		$cMonth = date('m', strtotime($c[4]));
		$cDay = date('d', strtotime($c[4]));
		if($year == $cYear && $month == $cMonth && $day == $cDay)
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
