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

		if(handle_csv('files/users.csv', $username, $password) == true){
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
			$msg = 'You have entered valid user name and password';
		}
		else $msg = 'Wrong username or password';
		debug_to_console($msg);
	}
	else {
		$msg = 'Wrong username or password';
		debug_to_console($msg);
	}

	function handle_csv($name){
		$row = 1;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$flag = false;
		if (($handle = fopen($name, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $row++;
		        $usr = $data[0];
		        $pw = $data[1];
		        //debug_to_console("USR ".$usr." PW" . $pw);
		        //debug_to_console("USeR ".$username." PeW " . $password);

		        if($usr == $username && $password == $pw) 
		        	$flag = true;
		    } 
		    fclose($handle);
		}
		return $flag;
	}


	function debug_to_console( $data ) {
	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}	
	//$file = $_ENV['OPENSHIFT_DATA_DIR'].'/../'
?>