<div class="wrap">
	<div class="pad"></div>
	<div class="base-left"></div>
    <div class="base-right"></div>
    <div class="base-left-2"></div>
    <div class="base-right-2"></div>
    <div class="toe-1"></div>
    <div class="toe-2"></div>
    <div class="toe-3"></div>
    <div class="toe-4"></div>
</div>
<script type="text/javascript" src="js/notifikacije.js"></script>
<?php 
	include 'db.php'; 
?>
<script>
 		notifikacija();
 		setInterval(notifikacija, 1500);
</script>
<header><h1>Azil za životinje - ŠAPA</h1></header><br>

<nav>
	<ul>
		<li><b><a <?php echo ($page == 'index') ? "class='active'" : ""; ?> href="index.php">NASLOVNICA</a></b></li>
		<li><b><a <?php echo ($page == 'usvoji') ? "class='active'" : ""; ?> href="usvoji.php">USVOJI</a></b></li>
		<!--<li><b><a <?php //echo ($page == 'foster') ? "class='active'" : ""; ?> href="postanifoster.php">POSTANI FOSTER</a></b></li>-->
		<li><b><a <?php echo ($page == 'oazilu') ? "class='active'" : ""; ?> href="oazilu.php">O AZILU</a></b></li>
		<li><b><a <?php echo ($page == 'contact') ? "class='active'" : ""; ?> href="contact.php">KONTAKT</a></b></li>
		<?php
			if(isset($_SESSION['username']) && ($_SESSION['username'] != 'admin')){
				print "<li><b><a ";
				print ($page == 'dodavanjenovosti') ? "class='active'" : "";
				print " href='dodavanjenovosti.php'>DODAVANJE NOVOSTI</a></b></li>";
			}
		?>
		<li><b><a <?php echo ($page == 'login') ? "class='active'" : ""; ?> href="login.php">LOGIN</a></b></li>
		<?php

			if(isset($_SESSION['username']) && $_SESSION['username'] == "admin"){
				print "<li><b><a ";
				print ($page == 'admin') ? "class='active'" : "";
				print " href='admin.php'>ADMIN</a></b></li>";
			}

			if(isset($_SESSION['username']) && $_SESSION['username'] != "admin")
			{				
				//promjena passworda
				print "<li><b><a ";
				print ($page == 'account') ? "class='active'" : "";
				print " href='account.php'>PROFIL</a></b></li>";
				//notifikacije
				print "<li id='notif'><a href='index.php'></a></li>";
			}
		?>
	</ul>
</nav>