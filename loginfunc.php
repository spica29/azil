<?php
	session_start();
	$msg = '';
	//$username = "";
	//password = pw

	//handle_csv("users.csv");
	if(isset($_SESSION['username']))
	{
		debug_to_console("Prijavljen korisnik: " . $_SESSION['username']); 
	}
	else if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$veza = new PDO('mysql:host=localhost;dbname=wtazil;charset=utf8', 'root', 'root');
		$veza->exec("set names utf8");

		$upit = $veza->prepare("SELECT * FROM korisnik WHERE username= :username && password= md5(:password)");
		$upit->bindValue(':username', $username);
		//treba hesirati
		$upit->bindValue(':password', $password);
		$upit->execute();
		$nesto = NULL;
		
		if($upit->rowCount() > 0){
			$nesto = $upit->fetch(PDO::FETCH_LAZY);
			debug_to_console("Nesto " . $nesto["username"]);

			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
			//$msg = 'Username: ' . $username . " password: " . $password;
		}
		else debug_to_console("greska");
	}
	else {
		$msg = 'Wrong username or password';
		debug_to_console($msg);
	}

	function debug_to_console( $data ) {
	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}	
?>