



$('#glasaj').click(function(ev){

   var odg = $('.odgovor:checked').val();
   var token = document.querySelector("input[name='_token']").value;

        $.ajax({
         type: 'POST',
         url: baseUrl + '/anketa/dodajGlas',
         data: {
            _token: token,
            odgovor: odg
        },
        success: function(podaci){
        console.log(podaci);
        generisiRezultate();

    $('#anketaObavestenje').css('display', 'block');
    $('#anketaObavestenje').html(podaci);
    },

    error: function(greske){
    console.log(greske);
    $('#anketaObavestenje').css('display', 'block');
    $('#anketaObavestenje').html(greske);
    }
  });
 ev.preventDefault();
});



function prikaziOdgovore(id){
    var token = document.querySelector("input[name='_token']").value;
    $.ajax({
        type: 'POST',
        url: baseUrl + '/ankete/prikaziOdgovore/' + id,
        data: {
          _token: token
        },
        success: function(podaci){
        console.log(podaci);
        if(podaci.length == 0){
        $('#odgovori').html("Nema odgovora");
        }
        else{
        $('#odgovori').html(prikazOdgovora(podaci));
        }
        
        },
        error: function(greske){
        console.log(greske);
      }
    });
}





function prikazOdgovora(odgovori){
  var ispis = "<table class='table'><tr><th>id</th><th>odgovor</th><th>rezultat</th><th>brisanje</th></tr>";
  for(var i=0; i<odgovori.length; i++){
  ispis += "<tr><td>"+odgovori[i].idOdgovor+"</td><td>"+odgovori[i].odgovor+"</td><td>"+odgovori[i].rezultat+"</td><td><a href='"+baseUrl+'ankete/odgovor/brisi/'+odgovori[i].idOdgovor+"'>briši</a></td></tr>";
  }
  ispis += "</table>";
  return ispis;
}






$(document).ready(function(){

  generisiRezultate();

});



function generisiRezultate() {

  $.ajax({
    type: 'GET',
    url: baseUrl + '/ankete/rezultati',
    success: function(podaci){
      console.log(podaci);

      var ispis = "<table class='table'>";
      for(var i=0; i < podaci.length; i++){
        ispis += "<tr>";
        ispis += "<td>" + podaci[i].odgovor + "</td>";
        ispis += "<td>" + podaci[i].rezultat + "</td>";
        ispis += "</tr>";
      }
      ispis += "</table>";

      $('#rezultatAnkete').html(ispis);

    },
    error: function(greske){
      console.log(greske);
    }
  });
}

