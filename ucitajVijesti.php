<?php
	include 'db.php';
	$novosti = ucitajNovosti();
	$vrijeme = $_REQUEST['vrijeme'];
	
	$currentDate = date("Y/m/d H:i:s");
	$year = date('y', strtotime($currentDate));
	$month = date('m', strtotime($currentDate));
	$day = date('d', strtotime($currentDate));
	$dayOfTheWeek = date('N', strtotime($currentDate));

	foreach ($novosti->fetchAll() as $c) {
		$vr = $c['vrijeme'];
		$cYear = date('y', strtotime($vr));
		$cMonth = date('m', strtotime($vr));
		$cDay = date('d', strtotime($vr));
		$cDayOfTheWeek = date('N', strtotime($vr));
		$razlikaUDanima = $day - $cDay;
			
		if($year == $cYear && $month == $cMonth && $day == $cDay && $vrijeme == "dnevni")
		{
			ispisiVijest($c);
		}
		else if($vrijeme == "sve") ispisiVijest($c);	
		else if($year == $cYear && $month == $cMonth && $vrijeme == "mjesecni")
		{
			ispisiVijest($c);
		} else if($dayOfTheWeek - $cDayOfTheWeek < 7 && $dayOfTheWeek - $cDayOfTheWeek >= 0 && $razlikaUDanima < 7 && $razlikaUDanima >= 0 && $vrijeme == "sedmicni"){
			ispisiVijest($c);
		}
	}

	function ispisiVijest($c){
		print "<article class='vijest'>
				<a href='detaljniPrikaz.php?id=" . $c['id'] . "'><img src='" . $c['urlslike'] . "' alt='slika'/></a>
				<h3>";
		print $c['naslov'] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $c['vrijeme'] . "</div>";

		$opis = $c['opis'];
		//racunanje pozicije od koje ce traziti space za skracivanje stringa
		$vel = strlen($opis);
		if($vel > 250) $vel = 250;
		else $vel = 0;
		//nalazenje pozicije
		$pozicija = strpos($opis, " ", $vel);
		//print "pozicija: " . $pozicija;
		if(strlen($opis) > 250) {
			$opis = substr($opis, 0, $pozicija);
			print "<p>" . $opis . " .."; 
		}
		else 
			print "<p>" . $c['opis'];
		print "</p></article>";
	}

	function debug_to_console( $data ) {
	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}	
?>
