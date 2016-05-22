<?php
	//citanje csv-a
	$file = file("files/novosti.csv");
	$vrijeme = $_REQUEST['vrijeme'];
	debug_to_console($vrijeme);
	$currentDate = date("Y/m/d H:i:s");
	$year = date('y', strtotime($currentDate));
	$month = date('m', strtotime($currentDate));
	$day = date('d', strtotime($currentDate));
	$dayOfTheWeek = date('N', strtotime($currentDate));
	foreach ($file as $r) {
		$c = explode(',', $r);
		$cYear = date('y', strtotime($c[4]));
		$cMonth = date('m', strtotime($c[4]));
		$cDay = date('d', strtotime($c[4]));
		$cDayOfTheWeek = date('N', strtotime($c[4]));
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
				<img src='" . $c[5] . "' alt='slika'/>
				<h3>";
			print $c[0] . "</h3>
			<div class='opisVremena'></div>
			<div class='vrijeme'>" . $c[4] . "</div>
			<p>" . $c[1] . "</p>
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
