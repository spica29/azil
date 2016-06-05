function notifikacija(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200){
			var notifikacije = document.getElementById("notif");

			if(ajax.response > 0){
				notifikacije.firstChild.innerHTML = "Nepročitani komentari: " + ajax.response;
				notifikacije.firstChild.style.visibility = 'visible'; 
			}
			else{
				notifikacije.firstChild.innerHTML = "";
			 	notifikacije.style.visibility = 'hidden';
			}
		}
	}
	ajax.open("GET", "notifikacije.php");
	ajax.send();
}