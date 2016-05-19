window.onload = function(){
	//ucitaj();
	vrijeme();
}

function vrijeme() {
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

/*
Potrebno je napraviti filtriranje novosti po vremenu objave. 
Korisniku treba biti ponuđena mogućnost odabira: današnje novosti, novosti ove sedmice, novosti ovog mjeseca i sve novosti

Potrebno je imati bar 12 novosti čiji datumi objava trebaju biti različiti i treba biti bar jedna novost u svakoj kategoriji. 
Ovo je potrebno zbog testiranja.

*/

function dnevni(){
	//brisanje 
	var section1 = document.getElementsByTagName("section");
	for(var i = 0; i < section1.length; i++){
		while(section1[i].firstChild)
			section1[i].removeChild(section1[i].firstChild);
	}

	//
	vrijeme();

	return false;
}


function mjesecni(){
	//brisanje 
	var section = document.getElementsByTagName("section");
	for(var i = 0; i < section.length; i++){
		while(section[i].firstChild)
			section[i].removeChild(section[i].firstChild);
	}
	//ucitavanje novih

	/*var section = document.getElementById("section");
	var h2 = document.createElement("h2");
	h2.innerHTML = "Naslovna";
	section.appendChild(h2);
	
	for(var i = 0; i < podaci_json.length; i++){
		var currentDate = new Date();
		var date = new Date(podaci_json[i].vrijeme);
		if(date.getMonth() == currentDate.getMonth() && date.getFullYear() == currentDate.getFullYear()){
			ucitajPojedinacno(podaci_json[i], section);
		}
	}*/

	vrijeme();
	return false;
}

function sve(){
	//brisanje 
	var section = document.getElementsByTagName("section");
	for(var i = 0; i < section.length; i++){
		while(section[i].firstChild)
			section[i].removeChild(section[i].firstChild);
	}
	//ucitavanje svih

	/*var section = document.getElementById("section");
	var h2 = document.createElement("h2");
	h2.innerHTML = "Naslovna";
	section.appendChild(h2);
	
	for(var i = 0; i < podaci_json.length; i++){
		var currentDate = new Date();
		var date = new Date(podaci_json[i].vrijeme);
		ucitajPojedinacno(podaci_json[i], section);
	}*/

	vrijeme();
	return false;
}

function sedmicni(){
	//brisanje 
	var section = document.getElementsByTagName("section");
	for(var i = 0; i < section.length; i++){
		while(section[i].firstChild)
			section[i].removeChild(section[i].firstChild);
	}

	//ucitavanje novih
	ucitaj();
	/*var section = document.getElementById("section");
	var h2 = document.createElement("h2");
	h2.innerHTML = "Naslovna";
	section.appendChild(h2);
	
	for(var i = 0; i < podaci_json.length; i++){
		var currentDate = new Date();
		var date = new Date(podaci_json[i].vrijeme);
		var razlikaUDanima = Math.floor((currentDate - date) / (1000 * 3600 * 24));
		console.log("razlika " + razlikaUDanima);
		var currentDanUSedm = currentDate.getDay() - 1;
		var DanUSedm = date.getDay() - 1;
		if(DanUSedm < 0) DanUSedm = 7;
		if(currentDanUSedm < 0) currentDanUSedm = 7;
		if(currentDanUSedm - DanUSedm < 7 && currentDanUSedm - DanUSedm >= 0 && razlikaUDanima < 7){
			ucitajPojedinacno(podaci_json[i], section);
		}
	}*/

	vrijeme();
	return false;
}

function ucitaj(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
   		if (ajax.readyState == 4 && ajax.status == 200){
   			
   		}    	
    }
	ajax.open("GET", "ucitajVijesti.php");
	ajax.send();
}

function ucitajPojedinacno(podatak, section){
	//pravljenje article
	var article = document.createElement("article");
	article.className = "vijest";
	//dodavanje slike
	var img = document.createElement("img");
	img.src = podatak.slika;
	img.alt = podatak.alt;
	article.appendChild(img);

	//dodavanje naslova
	var h3 = document.createElement("h3");
	h3.innerHTML = podatak.naslov;
	article.appendChild(h3);

	var opisVremena = document.createElement("div");
	opisVremena.className = "opisVremena";
	article.appendChild(opisVremena);

	//dodavanje vremena
	var vrijemeObjave = document.createElement("div");
	vrijemeObjave.className = "vrijeme";
	//console.log(podatak.vrijeme)
	var vr = new Date(podatak.vrijeme);
	//console.log(vr);
	vrijemeObjave.innerHTML = podatak.vrijeme;
	article.appendChild(vrijemeObjave);

	//dodavanje teksta
	var p = document.createElement("p");
	p.innerHTML = podatak.tekst;
	article.appendChild(p);

	section.appendChild(article);
}

//podaci su testni za 2.4 i 3.4 naravno na dan testiranja treba promijeniti vrijednosti da bi dnevni prikaz radio
var podaci_json = [
	{
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/05/19 11:00:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/04/20 03:04:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/05/01 03:04:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/04/02 03:04:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/04/02 17:04:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/02/02 03:04:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/02/02 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}, {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/03/31 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}  , {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/03/25 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}  , {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/03/28 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}  , {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/03/27 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}  , {
		"slika": "images/dog-and-puppy-adoption.jpg",
		"naslov": "Usvajanje",
		"vrijeme": "2016/04/03 03:14:05",
		"opisVremena": "",
		"alt": "Adopt me",
		"tekst": "Budući vlasnici pasa, osim sa razmišljanjima o tome kako će se porodica organizovati u brizi i šetanju ljubimca, najčešće se suočavaju i sa dilemom da li će usvojiti štene ili odraslog psa. U poslednje vreme na društvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje."
	}  
]