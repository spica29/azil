<?php
	$username = null;
	$vijest = null;
	$komentarParent = null;
	$tekstKomentara = null;
	//korisnici
	if(isset($_SESSION['username'])){
		$username = htmlEntities($_SESSION['username'], ENT_QUOTES);
	} else {
		if(isset($_POST['username'])){
			$username = htmlEntities($_POST['username'], ENT_QUOTES);
			//dodavanje u bazu
			dodajGosta($username);
		}
	}

	//id vijesti
	if(isset($_GET['id'])){
		$vijest = htmlEntities($_GET['id'], ENT_QUOTES);
	}

	//tekst komentara
	if(isset($_POST['tekstOdgovora']) && !empty($_POST['tekstOdgovora'])){
		$tekstKomentara = htmlEntities($_POST['tekstOdgovora'], ENT_QUOTES);
		if(isset($_POST['komentar_id'])){
			$komentarParent = htmlEntities($_POST['komentar_id'], ENT_QUOTES);;
		} else $komentarParent = NULL;	
	} else if (isset($_POST['tekstKomentara']))
	{
		$tekstKomentara = htmlEntities($_POST['tekstKomentara'], ENT_QUOTES);
	}

	dodajKomentar($tekstKomentara, $komentarParent, $username, $vijest);
	
?>