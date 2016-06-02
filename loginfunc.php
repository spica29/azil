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

		$username = htmlEntities($_POST['username'], ENT_QUOTES);
		$password = htmlEntities($_POST['password'], ENT_QUOTES);

		include 'db.php';
		login($username, $password);

		/*$upit = $veza->prepare("SELECT * FROM korisnik WHERE username= :username && password= md5(:password)");
		$upit->bindValue(':username', $username);
		//treba hesirati
		$upit->bindValue(':password', $password);
		$upit->execute();
		
		if($upit->rowCount() > 0){
			$nesto = $upit->fetch(PDO::FETCH_LAZY);
			debug_to_console("Nesto " . $nesto["username"]);

			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
			//$msg = 'Username: ' . $username . " password: " . $password;
		}
		else debug_to_console("greska");*/
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