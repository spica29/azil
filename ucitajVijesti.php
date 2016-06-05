<?php
	$vrijeme;// = "sve";
	if(!empty($_GET['vrijeme'])){
		$vrijeme = $_GET['vrijeme'];
	} else $vrijeme = "sve";
	
	$autor;
	if(isset($_GET['autor']))
	{
		$autor = $_GET['autor'];
	}
	else $autor = null;
	ucitajVijesti($vrijeme, $autor);

	function ucitajVijesti($vrijeme, $autor){
		include 'loginfunc.php';
		include 'db.php';

		$novosti;
		if($autor == null)
			$novosti = ucitajNovosti();
		else 
			$novosti = nadjiNovostiAutora($autor);

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
			else if($year == $cYear && $month == $cMonth && $vrijeme == "mjesecni")
			{
				ispisiVijest($c);
			} else if($dayOfTheWeek - $cDayOfTheWeek < 7 && $dayOfTheWeek - $cDayOfTheWeek >= 0 && $razlikaUDanima < 7 && $razlikaUDanima >= 0 && $vrijeme == "sedmicni"){
				ispisiVijest($c);
			} else if ($vrijeme == "sve") {
				ispisiVijest($c);
			}
		}
	}

	
?>
