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
?>