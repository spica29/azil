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

	function postaviProcitaneKomentare($idNovosti){
		$veza = konekcija();
		$autorID = nadjiAutora();

		if($autorID == false) return;

		$upit = $veza->prepare("SELECT id FROM novost WHERE autor_id = :id");
		$upit->bindValue(':id', $autorID);
		$upit->execute();
		print "<script>console.log('autor: " . $upit->fetch(PDO::FETCH_LAZY)['id'] . "')</script>";
		//$idNovost = $upit->fetch(PDO::FETCH_LAZY)['id'];

		$flag = false;
		foreach($upit->fetchAll() as $novostAutora){
			if($novostAutora == $idNovosti) return;	
		}

			

		$upit = $veza->prepare("UPDATE komentar SET procitan=1 WHERE novost_id = :id");
		$upit->bindValue(':id', $idNovosti);
		$upit->execute();
	}

	function izbrojNeprocitaneSveVijesti(){
		$autorID = nadjiAutora();
		$novosti = nadjiNovostiAutora($autorID);
		$suma = 0;
		foreach ($novosti as $novost) {
			$suma += brojNeprocitanih($novost['id']);
		}
		return $suma;
	}

	function brojNeprocitanih($idNovosti){
		//treba prebrojati neprocitane komentare
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * From KOMENTAR WHERE novost_id = :id AND PROCITAN = 0");
		$upit->bindValue(':id', $idNovosti);
		$upit->execute();
		return $upit->rowCount();
	}

	function ispisiNotifikaciju($idNovosti){
		//provjera je li vijest od autora koji je prijavljen
		$autorID = nadjiAutora();

		$veza = konekcija();
		$upit = $veza->prepare("SELECT * From novost WHERE id = :id AND autor_id = :idAutora");
		$upit->bindValue(':id', $idNovosti);
		$upit->bindValue(':idAutora', $autorID);
		$upit->execute();
		
		//autor novosti nije korisnik koji je prijavljen
		if($upit->rowCount() <= 0) return; 

		$broj = brojNeprocitanih($idNovosti);
		if($broj > 0){
			print "<p>Broj nepročitanih komentara: ";
			print $broj;
			print "</p>";
		}		
	}

	function ispisiVijest($c){
		print "<article class='vijest'>
				<a href='detaljniPrikaz.php?id=" . $c['id'] . "'><img src='" . $c['urlslike'] . "' alt='slika'/></a>
				<h3>";
		print $c['naslov'] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $c['vrijeme'] . "</div>";
		//ispis notifikacija za autora
		if(isset($_SESSION['username']) && nadjiTipKorisnika() == 2){
			ispisiNotifikaciju($c['id']);	
		}

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

	function nadjiKorisnika(){
		$username = NULL;
		if(isset($_SESSION['username']))
			$username = $_SESSION['username'];
		$veza = konekcija();
		$upit = $veza->prepare("SELECT id FROM korisnik WHERE username= :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['id'];;
		}
	}

	function nadjiTipKorisnika(){
		$veza = konekcija();
		$idKorisnika;
		$idKorisnika = nadjiKorisnika();

		$upit = $veza->prepare("SELECT tipkorisnika_id FROM korisnik WHERE id= :idKorisnika");
		$upit->bindValue(':idKorisnika', $idKorisnika, PDO::PARAM_INT);
		$upit->execute();
		return $upit->fetch(PDO::FETCH_LAZY)['tipkorisnika_id'];	
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
		$upit = $veza->prepare("SELECT id FROM autor WHERE korisnik_id = :id");
		$upit->bindValue(':id', $id, PDO::PARAM_INT);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['id'];
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

	function prikaziVijest($vijest, $autor, $idVijesti){
		$stranica = 'detaljniPrikaz.php?id=' . $idVijesti;
		print "<article class='vijest'><form method='POST' action=" . $stranica . ">
				<img src='" . $vijest['urlslike'] . "' alt='slika'/>
				<h3>";
		print $vijest['naslov'] . "</h3>
		<div class='opisVremena'></div>
		<div class='vrijeme'>" . $vijest['vrijeme'] . "</div>";
		//prikaz autora
		print "<h4 id='autor'>Autor: <a href='index.php?autor=" . $autor['id'] . "'>" . $autor['naziv'] . "</a></h4>";
		print "<p>" . $vijest['opis'];

		if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin')
		{
			//brisanje vijesti ako je admin
			print "<br><input type='submit' name='obrisiVijest' value='Obriši vijest'>";
			//upravljanje komentarisanjem
			if(dozvoljenoKomentarisanje($idVijesti))
			{
				print "<br>Komentarisanje dozvoljeno<input type='submit' name='zabraniKomentarisanje' id='kom' value='Zabrani komentarisanje'>";
			} else {
				print "<br>Komentarisanje zabranjeno<input type='submit' name='dozvoliKomentarisanje' id='kom' value='Dozvoli komentarisanje'>";
			}
		}		

		print "</p></form></article>";
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

	function formaZaUnosKomentara($korisnik, $idNovosti){
		$stranica = 'detaljniPrikaz.php?id=' . $idNovosti;
		print "<form id='unosKomentara' method='POST' action=" . $stranica . ">";
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
			print "<input type='submit' value='Komentariši'>";
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

	function nadjiKorisnikaUsernamePW($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM korisnik WHERE id= :id");
		$upit->bindValue(':id', $id);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch();
		}
	}

	function nadjiOdgovore($idParenta){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM komentar WHERE komentar_id = :idParent");
		$upit->bindValue(':idParent', $idParenta, PDO::PARAM_INT);
		$upit->execute();
		
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function ispisKomentara($komentar){
		print "<article id='komentar'>";
		//nalazenje korisnika koji je napisao komentar
		$korisnik = nadjiKorisnikaUsernameID($komentar['korisnik_id']);
		print "<p>" . $korisnik . ": ";
		//nalazenje teksta komentara
		$tekstKomentara = $komentar['komentar'];
		print $tekstKomentara . "</p>";
	}

	function ispisformeOdg($komentar){
		$stranica = 'detaljniPrikaz.php?id=' . $komentar['novost_id'];
		print "<form id='odgovor' method='POST' action=" . $stranica . ">";
			print "Odgovori: <br>";
			if(!isset($_SESSION['username']))
			{
				print "<label for='username'>Nick: </label>
				<input type='text' name='username' id='username' required>  ";
				print " <label for='tekstOdgovora'>Tekst komentara: </label>";
			} else {
				print "<label for='username'> " . $_SESSION['username'] . ": </label> ";
			}
			
			print "<textarea name='tekstOdgovora' id='tekstOdgovora' cols='100' rows='1'></textarea>";
			print "<input name='komentar_id' type='hidden' value='".$komentar["id"]."' >";
			print "<input type='submit' value='Odgovori'>";
			if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
				print "<input type='submit' name='obrisiKomentar' value='Obriši'>";
			}
		print "</form>";
	}

	function obrisiKomentarDB($komentarID){
		$veza = konekcija();
		$upit = $veza->prepare("DELETE FROM komentar WHERE id=:id");
		$upit->bindValue(':id', $komentarID, PDO::PARAM_INT);
		$upit->execute();
	}

	function obrisiKomentar($komentar){
		$odgovori = nadjiOdgovore($komentar);
		$imaDjecu = false;
		if($odgovori != false){$imaDjecu = true;}
		//print "<script>console.log(' komentar ID " . $komentar . " djecu: " . $imaDjecu . "')</script>";
		if($odgovori != false)
		{
			//ako ima odgovora ide dalje
			foreach ($odgovori->fetchAll() as $odgovor) {		
				$odgovori = nadjiOdgovore($odgovor['id']);
				if($odgovori != false){
					//obrisiKomentarDB($odgovor['id']);
					obrisiKomentar($odgovor['id']);	
				}
				//print "<script>console.log(' usao odg " . $odgovor['komentar'] . "')</script>";
				obrisiKomentarDB($odgovor['id']);
			}	
		}
		//ako nema odgovora brise komentar 
		//print "<script>console.log(' usao odg " . $komentar['komentar'] . "')</script>";
		obrisiKomentarDB($komentar);
		return;
		
	}

	function rekurzija($komentar){
		$odgovori = nadjiOdgovore($komentar['id']);
		if($odgovori != false){
			foreach ($odgovori->fetchAll() as $odgovor) {
				ispisKomentara($odgovor);
				ispisformeOdg($odgovor);
				
				$odgovori = nadjiOdgovore($odgovor['id']);
				if($odgovori != false){
					rekurzija($odgovor);
				} 
				print "</article>";
			}	
		}
		else {
			return;
		}		
	}

	function ispisivanjeKomentaraVijesti($komentari){
		//ispisivanje komentara
		print "<section id='komentari'>";
		print "<h3>Komentari:</h3>";
		
		foreach($komentari->fetchAll() as $komentar){
			if($komentar['komentar_id'] == null){
				ispisKomentara($komentar);
				rekurzija($komentar);
				ispisformeOdg($komentar);
				print "</article>";
			}	
		}			

		print "</section>";
	}

	function dodajGosta($username){
		$veza = konekcija();
		//upis gosta
		$upit = $veza->prepare("INSERT INTO korisnik (username, tipkorisnika_id, password) 
			VALUES (:username, :tipkorisnika_id, :password)");
		$upit->bindValue(':username', $username);
		$upit->bindValue(':tipkorisnika_id', 3, PDO::PARAM_INT);
		$upit->bindValue(':password', NULL);
		$upit->execute();
	}

	function nadjiKorisnikaSaUsername($username){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT id FROM korisnik WHERE username= :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['id'];
		}
	}

	function dodajKomentar($tekstKomentara, $komentarParent, $username, $vijest){
		$veza = konekcija();
		$korisnik = nadjiKorisnikaSaUsername($username);
		if($korisnik == false){
			//echo "Nije nadjen korisnik";	
			return;
		} 

		//upis komentara
		$upit = $veza->prepare("INSERT INTO komentar (komentar, novost_id, komentar_id, procitan, korisnik_id) 
			VALUES (:komentar, :novost_id, :komentar_id, :procitan, :korisnik_id)");
		$upit->bindValue(':komentar', $tekstKomentara);
		$upit->bindValue(':novost_id', $vijest, PDO::PARAM_INT);
		$upit->bindValue(':komentar_id', $komentarParent, PDO::PARAM_INT);
		$upit->bindValue(':procitan', 0, PDO::PARAM_INT);
		$upit->bindValue(':korisnik_id', $korisnik, PDO::PARAM_INT);
		$upit->execute();
	}

	function ucitajAutore(){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT * FROM autor");
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit;
		}
	}

	function ispisiAutore(){
		$autori = ucitajAutore();
		if($autori == false) echo "Nema autora";
		else {
			foreach($autori->fetchAll() as $autor){
				ispisiAutora($autor);
			}
		}
	}

	function ispisiAutora($autor){
		$korisnik = nadjiKorisnikaUsernamePW($autor['korisnik_id']);
		print "<article>";
		print "<form action='admin.php' method='post'>";
			print "<label for='naziv'>Naziv: </label>
			<input type='text' name='naziv' id='naziv' value='" . $autor['naziv'] . "' required>";
			print " <label for='usernameKorisnika'>Username: </label>
			<input type='text' name='usernameKorisnika' id='usernameKorisnika' value='" . $korisnik['username'] . "' required>
			<input type='hidden' name='starUsername' value='" . $korisnik['username'] . "' required>";
			print "<input type='submit' name='ponisti' value='PONIŠTI'>";
			print "<input type='submit' name='edit' value='SPASI PROMJENE'>";
			print "<input type='submit' name='brisanje' value='OBRIŠI'>";
			print "</form>";
		print "</article>";
	}

	function korisnikIDprekoUsername($username){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT id FROM korisnik WHERE username = :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['id'];
		}
	}

	function idAutoraPrekoIDKorisnika($idKorisnika){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT id FROM autor WHERE korisnik_id = :id");
		$upit->bindValue(':id', $idKorisnika);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['id'];
		}
	}

	function nazivAutora($id){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT naziv FROM autor WHERE id = :id");
		$upit->bindValue(':id', $id);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return $upit->fetch(PDO::FETCH_LAZY)['naziv'];
		}
	}

	function editujAutora($username, $naziv, $stariUsername){
		$veza = konekcija();
		$idKorisnika = korisnikIDprekoUsername($stariUsername);
		$autor = idAutoraPrekoIDKorisnika($idKorisnika);

		//update naziva
		if($autor == false || $idKorisnika == false) return;

		$upit = $veza->prepare("UPDATE autor SET naziv=:naziv WHERE id=:id");
		$upit->bindValue(':id', $autor, PDO::PARAM_INT);
		$upit->bindValue(':naziv', $naziv);
		$upit->execute();
		//update username
		$upit = $veza->prepare("UPDATE korisnik SET username=:username WHERE id=:idK");
		$upit->bindValue(':idK', $idKorisnika, PDO::PARAM_INT);
		$upit->bindValue(':username', $username);
		$upit->execute();
	}

	function obrisiAutora($username){
		$veza = konekcija();
		$idKorisnika = korisnikIDprekoUsername($username);
		$autor = idAutoraPrekoIDKorisnika($idKorisnika);

		if($autor == false || $idKorisnika == false) return;

		//prije svega treba obrisati sve njegove novosti i komentare
		$upit = $veza->prepare("SELECT * FROM komentar WHERE korisnik_id=:id");
		$upit->bindValue(':id', $idKorisnika, PDO::PARAM_INT);
		$upit->execute();
		$komentari = $upit->fetchAll();
		//prolazak kroz listu komentara
		foreach ($komentari as $komentar) {
			obrisiKomentar($komentar);
		}	

		//prije brisanja novosti treba obrisati sve komentare na novost autora
		$upit = $veza->prepare("SELECT * FROM novost WHERE autor_id=:id");
		$upit->bindValue(':id', $autor, PDO::PARAM_INT);
		$upit->execute();
		$novostiID = $upit->fetchAll();

		//brisanje
		foreach ($novostiID as $novostID) {
			$upit = $veza->prepare("SELECT * FROM komentar WHERE novost_id=:id");
			$upit->bindValue(':id', $novostID['id'], PDO::PARAM_INT);
			$upit->execute();
			$komentari = $upit->fetchAll();
			//prolazak kroz listu komentara
			foreach ($komentari as $komentar) {
				obrisiKomentar($komentar);
			}	
		}

		//brisanje novosti
		$upit = $veza->prepare("DELETE FROM novost WHERE autor_id=:id");
		$upit->bindValue(':id', $autor, PDO::PARAM_INT);
		$upit->execute();

		//brisanje iz tabele autora
		//stavljanje korisnik id na null
		$upit = $veza->prepare("DELETE FROM autor WHERE id=:id");
		$upit->bindValue(':id', $autor, PDO::PARAM_INT);
		$upit->execute();

		//brisanje iz tabele korisnika
		$upit = $veza->prepare("DELETE FROM korisnik WHERE id=:id");
		$upit->bindValue(':id', $idKorisnika, PDO::PARAM_INT);
		$upit->execute();
	}

	function postojiUsername($username){
		$veza = konekcija();
		$upit = $veza->prepare("SELECT id FROM korisnik WHERE username = :username");
		$upit->bindValue(':username', $username);
		$upit->execute();
		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return true;
		}
	}

	function dodajKorisnika($username, $naziv, $password){
		$veza = konekcija();
		//provjera postoji li username

		if(postojiUsername($username)) return false;
		//insert u korisnika
		$upit = $veza->prepare("INSERT INTO korisnik (username, password, tipkorisnika_id) 
			VALUES (:username, :password, :tipkorisnika_id)");
		$upit->bindValue(':username', $username);
		$upit->bindValue(':password', md5($password));
		$upit->bindValue(':tipkorisnika_id', 2, PDO::PARAM_INT);
		$upit->execute();

		$idKorisnika = korisnikIDprekoUsername($username);

		//insert u autora
		$upit = $veza->prepare("INSERT INTO autor (naziv, koddrzave, brojtelefona, korisnik_id) 
			VALUES (:naziv, :koddrzave, :brojtelefona, :korisnik_id)");
		$upit->bindValue(':naziv', $naziv);
		$upit->bindValue(':koddrzave', "ba");
		$upit->bindValue(':brojtelefona', "+387");
		$upit->bindValue(':korisnik_id', $idKorisnika, PDO::PARAM_INT);
		$upit->execute();
	}

	function obrisiVijest($idVijesti){
		$veza = konekcija();
		//brisanje komentara
		$upit = $veza->prepare("DELETE FROM komentar WHERE novost_id=:id");
		$upit->bindValue(':id', $idVijesti, PDO::PARAM_INT);
		$upit->execute();
		//brisanje vijesti
		$upit = $veza->prepare("DELETE FROM novost WHERE id=:id");
		$upit->bindValue(':id', $idVijesti, PDO::PARAM_INT);
		$upit->execute();
	}

	function zabraniKomentarisanje($idNovosti){
		$veza = konekcija();
		$upit = $veza->prepare("UPDATE novost SET komentaridozvoljeni=:kom WHERE id=:id");
		$upit->bindValue(':id', $idNovosti, PDO::PARAM_INT);
		$upit->bindValue(':kom', 0, PDO::PARAM_INT);
		$upit->execute();

		//brisanje komentara
		$upit = $veza->prepare("UPDATE komentar SET komentar_id=:kom WHERE novost_id=:id");
		$upit->bindValue(':id', $idNovosti, PDO::PARAM_INT);
		$upit->bindValue(':kom', NULL);
		$upit->execute();

		$upit = $veza->prepare("DELETE FROM komentar WHERE novost_id=:id");
		$upit->bindValue(':id', $idNovosti, PDO::PARAM_INT);
		$upit->execute();
	}

	function dozvoliKomentarisanje($idNovosti){
		$veza = konekcija();
		$upit = $veza->prepare("UPDATE novost SET komentaridozvoljeni=:kom WHERE id=:id");
		$upit->bindValue(':id', $idNovosti, PDO::PARAM_INT);
		$upit->bindValue(':kom', 1, PDO::PARAM_INT);
		$upit->execute();
	}

	function potvrdiPW($stariPW){
		$veza = konekcija();
		$username = $_SESSION['username'];
		$upit = $veza->prepare("SELECT * FROM korisnik WHERE username=:username AND password=md5(:password)");
		$upit->bindValue(':username', $username);
		$upit->bindValue(':password', $stariPW);
		$upit->execute();

		if($upit->rowCount() <= 0) {
			return false;
		}
		else {
			return true;
		}
	}

	function promijeniPW($stariPW, $noviPW){
		$veza = konekcija();
		$username = $_SESSION['username'];
		$upit = $veza->prepare("UPDATE korisnik SET password = md5(:novi) WHERE username=:username AND password=md5(:password)");
		$upit->bindValue(':username', $username);
		$upit->bindValue(':password', $stariPW);
		$upit->bindValue(':novi', $noviPW);
		$upit->execute();
	}
?>