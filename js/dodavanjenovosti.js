function validirajNaslov(obj){
	if(obj.value.length > 0)
		obj.style.backgroundColor = "white";
	else obj.style.backgroundColor = "#ff3333";
}

function validirajOpis(obj){
	if(obj.value.length > 0)
		obj.style.backgroundColor = "white";
	else obj.style.backgroundColor = "#ff3333";
}

function validirajPolja(){
   obj = document.getElementById("kodDrzave");
   obj2 = document.getElementById("brojTel");
   if(obj.style.backgroundColor == "rgb(255, 51, 51)" || obj2.style.backgroundColor == "rgb(255, 51, 51)"){
      alert('Ne poklapa se kod drzave se pozivnim, unesite ponovo podatke');
      return false;
   }
   else return true;
 }

function validirajDrzavu(obj){
	var obj2 = document.getElementById("brojTel")
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
   		if (ajax.readyState == 4 && ajax.status == 200){
   			var x = JSON.parse(ajax.responseText);
   			//console.log("ODG " + x[0].callingCodes);
   			//prvi znak mora biti + pa onda pozivni
   			if(x[0] != null && obj2.value[0] == "+"){
   				var pozivni = obj2.value.substring(1,4);
   				if(pozivni.startsWith(x[0].callingCodes)){
   					obj.style.backgroundColor = "white";
   					obj2.style.backgroundColor = "white";
   				}
   				else{
   					obj.style.backgroundColor = "#ff3333";
   					obj2.style.backgroundColor = "#ff3333";
   				}
   			}
   			else{
   				obj.style.backgroundColor = "#ff3333";
   				obj2.style.backgroundColor = "#ff3333";
   			}
   		}    	
    }
	ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + obj.value, true);
	ajax.send();
}


function validirajKod(obj2){
	var obj = document.getElementById("kodDrzave")
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
   		if (ajax.readyState == 4 && ajax.status == 200){
   			var x = JSON.parse(ajax.responseText);
   			//console.log("ODG " + x[0].callingCodes);
   			//console.log(obj.value)
   			if(x[0] != null  && obj2.value[0] == "+"){
   				var pozivni = obj2.value.substring(1,4);
   				if(pozivni.startsWith(x[0].callingCodes)){
   					obj.style.backgroundColor = "white";
   					obj2.style.backgroundColor = "white";
   				}
   				else{
   					obj.style.backgroundColor = "#ff3333";
   					obj2.style.backgroundColor = "#ff3333";
   				}
   			}
   			else{
   				obj.style.backgroundColor = "#ff3333";
   				obj2.style.backgroundColor = "#ff3333";
   			}
   		}    	
    }
	ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + obj.value, true);
	ajax.send();
}
