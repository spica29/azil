<?php
	function konekcija(){
		$veza = new PDO('mysql:host=localhost;dbname=wtazil;charset=utf8', 'root', 'root');
		$veza->exec("set names utf8");	
		return $veza;
	}

	function login($username, $password){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM korisnik WHERE username= :username && password= md5(:password)");
		$upit->bindValue(':username', $username);
		$upit->bindValue(':password', $password);
		$upit->execute();

		if($upit->rowCount() <= 0) return false;
		else {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $upit->fetch(PDO::FETCH_LAZY)['username'];
		}
	}

	function nadjiKorisnika(){
		$veza = konekcija();
		$username = $_SESSION['username'];
		$upit = $veza->prepare("SELECT id FROM korisnik WHERE username= :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function nadjiKorisnikaUsername(){
		$veza = konekcija();
		$username = $_SESSION['username'];
		$upit = $veza->prepare("SELECT username FROM korisnik WHERE username= :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['username'];
		}
	}

	function nadjiAutora(){
		$veza = konekcija();
		$id = nadjiKorisnika();
		$id = $id->fetch(PDO::FETCH_LAZY)['id'];
		$upit = $veza->prepare("SELECT id FROM autor WHERE korisnik_id = :id");
		$upit->bindValue(':id', $id, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function nadjiAutoraVijesti($idVijesti){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT autor_id FROM novost WHERE id=:id");
		$upit->bindValue(':id', $idVijesti, PDO::PARAM_INT);
		$upit->execute();
		return $upit->fetch(PDO::FETCH_LAZY)['autor_id'];
	}

	function nadjiAutoraID($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM autor WHERE id = :id");
		$upit->bindValue(':id', $id, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch();
		}
	}

	function unosVijesti($naslov, $opis, $vrijeme, $urlSlike, $dozvoljeniKomentari){
		$veza = konekcija();
		//nalazenje id autora
		$broj = nadjiAutora();
		$broj = $broj->fetch(PDO::FETCH_LAZY)['id'];
		//upis novosti
		$upit = $veza->prepare("INSERT INTO novost (naslov, opis, vrijeme, urlslike, komentaridozvoljeni, autor_id) 
			VALUES (:naslov, :opis, :vrijeme, :urlslike, :komentaridozvoljeni, :autor)");
		$upit->bindValue(':naslov', $naslov);
		$upit->bindValue(':opis', $opis);
		$upit->bindValue(':vrijeme', $vrijeme);
		$upit->bindValue(':urlslike', $urlSlike);
		$upit->bindValue(':komentaridozvoljeni', $dozvoljeniKomentari, PDO::PARAM_INT);
		$upit->bindValue(':autor', $broj, PDO::PARAM_INT);
		$upit->execute();
	}

	function ucitajNovosti(){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM novost");
		$upit->execute();
		return $upit;
	}

	function nadjiVijest($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM novost WHERE id=:id");
		$upit->bindValue(':id', $id, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch();
		}
	}

	function nadjiNovostiAutora($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM novost WHERE autor_id=:id");
		$upit->bindValue(':id', $id, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function prikaziVijest($vijest, $autor){
		print "<article class='vijest'>
				<img src='" . $vijest['urlslike'] . "' alt='slika'/>
				<h3>";
		print $vijest['naslov'] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $vijest['vrijeme'] . "</div>";
		//prikaz autora
		print "<h4 id='autor'>Autor: <a href='index.php?autor=" . $autor['id'] . "'>" . $autor['naziv'] . "</a></h4>";
		print "<p>" . $vijest['opis'];
		print "</p></article>";
	}

	function nadjiKomentare($idNovosti){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM komentar WHERE novost_id=:id");
		$upit->bindValue(':id', $idNovosti, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function formaZaUnosKomentara($korisnik){
		print "<form id='unosKomentara'>";
		print "<h3>Unos komentara</h3>";
			if($korisnik == null) //ako nije logovan trazi username gosta
				print "<label for='username'>Nick: </label>
					<input type='text' name='username' id='username' required><br>";
			else 
				print "<p>Korisnik: " . $_SESSION['username'] . "</p>";
			//unos teksta komentara
			print "<label for='tekstKomentara'>Tekst komentara: </label><br>
			<textarea name='tekstKomentara' id='tekstKomentara' cols='100' rows='5' required></textarea>
			<br>";
			print "<br><input type='submit' value='Komentariši'>";
		print "</form>";
	}

	function nadjiKorisnikaUsernameID($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT username FROM korisnik WHERE id= :id");
		$upit->bindValue(':id', $id);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['username'];
		}
	}

	function ispisivanjeKomentaraVijesti($komentari){
		//ispisivanje komentara
		print "<section id='komentari'>";
			print "<h3>Komentari:</h3>";
			foreach($komentari->fetchAll() as $komentar){
				print "<article id='komentar'>";
				//nalazenje korisnika koji je napisao komentar
				$korisnik = nadjiKorisnikaUsernameID($komentar['korisnik_id']);
				print "<p>" . $korisnik . ": ";
				//nalazenje teksta komentara
				$tekstKomentara = $komentar['komentar'];
				print $tekstKomentara . "</p>";

				//prikaz odgovora na komentar
				print "<form id='odgovor'>";
					print "Odgovori: <br>";
					print "<label for='username'>Nick: </label>
					<input type='text' name='username' id='username' required>  ";
					print " <label for='tekstOdgovora'>Tekst komentara: </label> 
					<textarea name='tekstOdgovora' id='tekstOdgovora' cols='100' rows='1' required></textarea><br>";
				print "</form>";

				print "</article>";
			}			
		print "</section>";
	}

	function dozvoljenoKomentarisanje($idNovosti){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT komentaridozvoljeni FROM novost WHERE id= :id");
		$upit->bindValue(':id', $idNovosti);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			if($upit->fetch(PDO::FETCH_LAZY)['komentaridozvoljeni'] == 1) return true;
			else return false;
		}
	}
?>