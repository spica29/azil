window.onload = function(){
	ucitaj("sve");
	sortirajVremenski();
	//vrijeme();
}

function sortirajVremenski(){
	var listaNovosti = document.getElementsByClassName('vijest');
	//if(vremenski.checked){
		listaNovosti = Array.prototype.slice.call(listaNovosti, 0);
		listaNovosti.sort(function(a, b){
			//console.log(a.childNodes[7].innerHTML + " drugi " + b.childNodes[7].innerHTML);
			var aDate = new Date(a.childNodes[7].innerHTML);
			var bDate = new Date(b.childNodes[7].innerHTML);
			return (aDate < bDate);
		});

		var section1 = document.getElementsByTagName("section");
		for(var i = 0; i < section1.length; i++){
			while(section1[i].firstChild)
				section1[i].removeChild(section1[i].firstChild);
		}

		var section = document.getElementById('section');
		for(var i = 0; i < listaNovosti.length; i++){
			section.appendChild(listaNovosti[i]);
		}
		return listaNovosti;
	//}
}

function sortirajAbecedno(){
	var listaNovosti = document.getElementsByClassName('vijest');
	//if(vremenski.checked){
		listaNovosti = Array.prototype.slice.call(listaNovosti, 0);
		listaNovosti.sort(function(a, b){
			//console.log(a.childNodes[7].innerHTML + " drugi " + b.childNodes[7].innerHTML);
			var aNaslov = a.childNodes[3].innerHTML;
			aNaslov = aNaslov.toLowerCase();
			var bNaslov = b.childNodes[3].innerHTML;
			bNaslov = bNaslov.toLowerCase();
			console.log("anas: " + aNaslov + " bnas " + bNaslov);
			return (aNaslov > bNaslov);
		});

		var section1 = document.getElementsByTagName("section");
		for(var i = 0; i < section1.length; i++){
			while(section1[i].firstChild)
				section1[i].removeChild(section1[i].firstChild);
		}

		var section = document.getElementById('section');
		for(var i = 0; i < listaNovosti.length; i++){
			section.appendChild(listaNovosti[i]);
		}
		return listaNovosti;
	//}
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

	ucitaj("dnevni");
}


function mjesecni(){
	//brisanje 
	var section = document.getElementsByTagName("section");
	for(var i = 0; i < section.length; i++){
		while(section[i].firstChild)
			section[i].removeChild(section[i].firstChild);
	}
	//ucitavanje novih
	ucitaj("mjesecni");
}

function sve(){
	//brisanje 
	var section = document.getElementsByTagName("section");
	for(var i = 0; i < section.length; i++){
		while(section[i].firstChild)
			section[i].removeChild(section[i].firstChild);
	}
	//ucitavanje svih

	ucitaj("sve");

	//vrijeme();
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
	ucitaj("sedmicni");
}

function ucitaj(varVrijeme){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
   		if (ajax.readyState == 4 && ajax.status == 200){
   			document.getElementById('section').innerHTML = ajax.responseText;
   			vrijeme();
   			sortirajVremenski();
   			return false;
   		}    	

    }
	ajax.open("GET", "ucitajVijesti.php?vrijeme=" + varVrijeme);
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