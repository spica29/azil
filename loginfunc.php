<?php
	session_start();
	$msg = '';
	//$username = "";
	//password = pw
	//include 'db.php';
	//handle_csv("users.csv");
	if(isset($_SESSION['username']))
	{
		//debug_to_console("Prijavljen korisnik: " . $_SESSION['username']); 
	}
	else if (isset($_POST['login'])) {
		$username = htmlEntities($_POST['username'], ENT_QUOTES);
		$password = htmlEntities($_POST['password'], ENT_QUOTES);

		include 'db.php';
		if(login($username, $password) == false){
			echo "Pogresan username ili password";
			header('Location: '. 'login.php');
		} else {
			login($username, $password);
		}
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