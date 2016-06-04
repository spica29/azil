<?php
	print "<br><h3>Dodaj novog korisnika</h3>";
	print "<form action='admin.php' method='post'>";
		print "<label for='naziv'>Naziv: </label>
		<input type='text' name='naziv' id='naziv' required>";
		print " <label for='username'>Username: </label>
		<input type='text' name='username' id='username' required>";
		print " <label for='password'>Password: </label>
		<input type='password' name='password' id='password' required>";
		print "<input type='submit' name='dodaj' value='Dodaj'>";
	print "</form>";
?>