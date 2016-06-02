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
		
		//debug_to_console("vrijeme: " . $vr . " godina: " . $cYear);
			
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
				<img src='" . $c['urlslike'] . "' alt='slika'/>
				<h3>";
			print $c['naslov'] . "</h3>
			<div class='opisVremena'></div>
			<div class='vrijeme'>" . $c['vrijeme'] . "</div>
			<p>" . $c['opis'] . "</p>
			</article>";
	}

	function debug_to_console( $data ) {
	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}	
?>
