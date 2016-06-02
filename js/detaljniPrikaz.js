window.onload = function(){
	//uzimanje datuma iz html-a
	var idDate = document.getElementsByClassName("vrijeme");
	var idOpisVremena = document.getElementsByClassName("opisVremena");
	
	for (var i = 0; i < idDate.length; i++) {
		var date = new Date(idDate[i].innerHTML);
		//console.log(date);
			
		var currentDate = new Date();
	
		razlika = currentDate - date; // rezultat u milisekundama

		razlika = razlika/1000; //izbacivanje milisekundi
		var seconds = Math.floor(razlika % 60); //uzimanje sekundi
		razlika = razlika / 60;
		var minutes = Math.floor(razlika % 60);//uzimanje minuta
		razlika = razlika / 60;
		var hours = Math.floor(razlika % 24);
		var days = Math.floor(razlika / 24);

		var tekst = provjera(seconds, minutes, hours, days);
		//console.log(tekst);
		if(tekst == ""){ 
			tekst = date.getFullYear() + "." + date.getMonth() + "." + date.getDate();
			if(date.getHours() < 10) 
				tekst += " 0" + date.getHours();
			else tekst += " " + date.getHours();
			if(date.getMinutes() < 10)
				tekst += ":0" + date.getMinutes();
			else tekst += ":" + date.getMinutes();
			if(date.getSeconds() < 10)
				tekst += ":0" + date.getSeconds();
			else tekst += ":" + date.getSeconds();
		}
		idOpisVremena[i].innerHTML = tekst;
	};
}

function provjera(seconds, minutes, hours, days) {
	var tekst;
	if (minutes < 1 && hours < 1 && days < 1)
	{
		//proslo manje od minute
		tekst = "Novost objavljena prije par sekundi";
	}
	else if(minutes > 0 && hours < 1 && days < 1)
	{
		//proslo manje od sat
		tekst = "Novost je objavljena prije ";
		if(minutes == 1){
			tekst += "1 minute";
		}
		else if(minutes > 1 && minutes < 5){
			tekst += minutes + " minute";
		}
		else tekst += minutes + " minuta";
	}
	else if(hours < 24 && days < 1){
		//proslo manje od dan
		tekst = "Novost je objavljena prije ";
		if(hours == 1){
			tekst += "1 sat";
		}
		else if(hours > 1 && hours < 5){
			tekst += hours + " sata";
		}
		else tekst += hours + " sati";	
	}
	else if(days < 7){
		//proslo manje od sedmice
		tekst = "Novost je objavljena prije ";
		if(days == 1){
			tekst += "1 dan";
		}
		else tekst += days + " dana";	
	}
	else if(days < 30){
		//proslo manje od mjesec
		var sedm = Math.floor(days / 7);
		if(sedm == 1){
			tekst = "Novost je objavljena prije " + sedm + " sedmicu";	
		}
		else tekst = "Novost je objavljena prije " + sedm + " sedmice";
	} else tekst = "";

	//document.getElementsByClassName("vrijeme").innerHTML = tekst;
	return tekst;
}