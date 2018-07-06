<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;


class Anketa {

public $idAnketa;
public $pitanje;
public $aktivna;
public $idKorisnik;
public $idAktivna;
public $idOdgovor;
public $odgovor;
private $table = 'anketa';


public function aktivna(){
return \DB::table($this->table)
->where('aktivna', '=', 1)
->first();
}

public function odgovori(){
return \DB::table($this->table)
->join('odgovor', 'odgovor.idAnketa', '=', 'anketa.idAnketa')
->where('aktivna', '=', 1)
->get();
}

public function proveraGlasanja(){
return \DB::table('glasanje')
->select('idKorisnik')
->where([
['idAnketa', '=', $this->idAktivna],
['idKorisnik', '=', $this->idKorisnik]
])
->first();
}


public function dodajGlas(){
return \DB::table('glasanje')
 ->insert(['idKorisnik' => $this->idKorisnik,
   'idAnketa' => $this->idAktivna,
   'idOdgovor' => $this->idOdgovor]);
}


public function azurirajRezultate(){
return \DB::table('rezultat')
->where([
['idAnketa', '=', $this->idAktivna],
['idOdgovor', '=', $this->idOdgovor]
])
->increment('rezultat', 1);
}


public function sveAnkete(){
return DB::table($this->table)
->get();
}


public function dodajAnketu(){
return DB::table($this->table)
->insert([
  'pitanje' => $this->pitanje
 ]);
}


public function dohvatiAnketu(){
return DB::table($this->table)
->where('idAnketa', '=', $this->idAnketa)
->first();
}


public function izmeniAnketu(){
return DB::table($this->table)
->where('idAnketa', $this->idAnketa)
->update(['pitanje' => $this->pitanje]);
}


public function izbrisiAnketu(){
return DB::table($this->table)
->where('idAnketa', $this->idAnketa)
->delete();
}


public function podesiAktivnu(){
$promenaAktivne = DB::table($this->table)
->where('aktivna', 1)
->update(['aktivna' => 0]);
return DB::table($this->table)
->where('idAnketa', $this->idAnketa)
->update(['aktivna' => 1]);
}


public function sviOdgovori(){
return DB::table('odgovor')
->join('rezultat', 'rezultat.idOdgovor', '=', 'odgovor.idOdgovor')
->where('odgovor.idAnketa', $this->idAnketa)
->get();
}


public function dodajOdgovor(){
$idOdg = DB::table('odgovor')
->insertGetId(
['idAnketa' => $this->idAnketa,
'odgovor' => $this->odgovor]
);
DB::table('rezultat')
->insert([
  'idAnketa' => $this->idAnketa,
  'idOdgovor' => $idOdg,
  'rezultat' => 0
]);
}



public function dohvatiOdgovor(){
return DB::table('odgovor')
->where('idOdgovor', $this->idOdgovor)
->first();
}




public function obrisiOdgovor(){
DB::table('rezultat')
->where('idOdgovor', $this->idOdgovor)
->delete();
return DB::table('odgovor')
->where('idOdgovor', $this->idOdgovor)
->delete();
}


public function obrisiOdgovoreAnkete(){
return DB::table('odgovor')
->where('idAnketa', $this->idAnketa)
->delete();
}




public function rezultati(){
return DB::table($this->table)
->join('odgovor', 'anketa.idAnketa', '=', 'odgovor.idAnketa')
->join('rezultat', 'odgovor.idOdgovor', '=', 'rezultat.idOdgovor')
->where('aktivna', '=', 1)
->get();
}



}


