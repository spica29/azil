function val_drzava(){ 
	var obj = document.getElementById("brojTel");
	var v1 = document.getElementById("drzava1").checked;
	var v2 = document.getElementById("drzava2").checked;
	var v3 = document.getElementById("drzava3").checked;
	if(v1){
		//validacija pozivnog za bih
		var re = /(00387|\+387)[6][0-6][0-9][0-9][0-9][0-9][0-9][0-9]/;
		var res = re.test(obj.value);
		if(res)
			obj.style.backgroundColor = "white";
		else
			obj.style.backgroundColor = "#ff3333";
	} else if(v2){
		//validacija pozivnog za srbiju
		var re = /(00381|\+381)[6][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/;
		var res = re.test(obj.value);
		if(res)
			obj.style.backgroundColor = "white";
		else
			obj.style.backgroundColor = "#ff3333";
	} else if(v3){
		//validacija pozivnog za hrvatsku
		var re = /(00385|\+385)[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/;
		var res = re.test(obj.value);
		if(res)
			obj.style.backgroundColor = "white";
		else
			obj.style.backgroundColor = "#ff3333";
	} else {
		obj.style.backgroundColor = "#ff3333";
	}
}

function validirajEmail(obj){
	var res = obj.value.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
	if(res == null)
		obj.style.backgroundColor = "#ff3333";
	else
		obj.style.backgroundColor = "white";
}

function validirajIme(obj){
	var reg = new RegExp("^[A-Za-z ]+$");
	var res = reg.test(obj.value);
	if(res)
		obj.style.backgroundColor = "white";
	else obj.style.backgroundColor = "#ff3333";
}

function validirajTel(obj){
	var v1 = document.getElementById("drzava1").checked;
	var v2 = document.getElementById("drzava2").checked;
	var v3 = document.getElementById("drzava3").checked;
	//obj.style.backgroundColor = "blue";
	if(v1){
		//validacija pozivnog za bih
		var reg = /(00387|\+387)[6][0-6][0-9][0-9][0-9][0-9][0-9][0-9]/;
		//console.log(obj.value);
		var res = reg.test(obj.value);
		if(res){
			obj.style.backgroundColor = "white";
		} else
			obj.style.backgroundColor = "#ff3333";
	} else if(v2){
		//validacija pozivnog za srbiju
		var re = /(00381|\+381)[6][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/;
		var res = re.test(obj.value);
		if(res)
			obj.style.backgroundColor = "white";
		else
			obj.style.backgroundColor = "#ff3333";
	} else if(v3){
		//validacija pozivnog za hrvatsku
		var re = /(00385|\+385)[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/;
		var res = re.test(obj.value);
		if(res)
			obj.style.backgroundColor = "white";
		else
			obj.style.backgroundColor = "#ff3333";
	} else {
		obj.style.backgroundColor = "#ff3333";
	}
}