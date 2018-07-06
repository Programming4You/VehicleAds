
function proveraReg(){


var reusername = /^[A-z0-9]{3,15}$/;
var repass = /^[A-z0-9]{4,15}$/;



var username = document.getElementById("tbKorisnickoImeRegistracija").value;
var pass = document.getElementById("tbLozinkaRegistracija").value;

var errors = [];


if(!reusername.test(username)){
errors.push("Korisnicko ime nije validno");
document.getElementById('tbKorisnickoImeRegistracija').style.borderColor="red";
document.getElementById('korImeErr').innerHTML = "<span style='color:#FF0000'>Moraju slova i brojevi (3-15)</span>";
}
else{
document.getElementById('tbKorisnickoImeRegistracija').style.borderColor="gray";
document.getElementById('korImeErr').style.display="none";
}

if(!repass.test(pass)){
errors.push("Lozinka nije validna");
document.getElementById('tbLozinkaRegistracija').style.borderColor="red";
document.getElementById('lozinkaErr').innerHTML = "<span style='color:#FF0000'>Moraju slova i brojevi (4-15)</span>";
}
else{
document.getElementById('tbLozinkaRegistracija').style.borderColor="gray";
document.getElementById('lozinkaErr').style.display="none";
}


if(errors.length>0){
return false;

  }
}







function proveraPrijava(){


var reusername = /^[A-z0-9]{3,15}$/;
var repass = /^[A-z0-9]{4,15}$/;



var username = document.getElementById("tbKorImePrijava").value;
var pass = document.getElementById("tbLozPrijava").value;

var errors = [];


if(!reusername.test(username)){
errors.push("Korisnicko ime nije validno");
document.getElementById('tbKorImePrijava').style.borderColor="red";
document.getElementById('korIErr').innerHTML = "<span style='color:#FF0000'>Moraju slova i brojevi (3-15)</span>";
}
else{
document.getElementById('tbKorImePrijava').style.borderColor="gray";
document.getElementById('korIErr').style.display="none";
}

if(!repass.test(pass)){
errors.push("Lozinka nije validna");
document.getElementById('tbLozPrijava').style.borderColor="red";
document.getElementById('lozErr').innerHTML = "<span style='color:#FF0000'>Moraju slova i brojevi (4-15)</span>";
}
else{
document.getElementById('tbLozPrijava').style.borderColor="gray";
document.getElementById('lozErr').style.display="none";
}


if(errors.length>0){
return false;

  }
}