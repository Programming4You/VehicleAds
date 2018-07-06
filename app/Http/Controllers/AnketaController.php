<?php

namespace App\Http\Controllers;


use App\Models\Anketa;
use App\Models\Korisnik;
use App\Models\Meni;
use Illuminate\Http\Request;


class AnketaController extends Controller
{
    
    private $data=[];


    public function __construct() {
        $meni=new Meni();
        $this->data['menus']=$meni->getAll();
    }




public function index($id = null){
    $anketa = new Anketa();
    if(!empty($id)){
    $anketa->idAnketa = $id;
    try{
    $this->data['anketa'] = $anketa->dohvatiAnketu();

    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    }
    }
    try{
    $this->data['ankete'] = $anketa->sveAnkete();
    return view('pages.ankete', $this->data);
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    }
}




public function izmenaOdgovora($id = null){
    $anketa = new Anketa();
    if(!empty($id)){
    $anketa->idOdgovor = $id;
    try{
    $this->data['odgovor'] = $anketa->dohvatiOdgovor();
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    }
    }

    try{
    $this->data['ankete'] = $anketa->sveAnkete();
    return view('admin.anketa', $this->data);
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    }
}







public function obrisiOdgovor($id){
    $anketa = new Anketa();
    try{
    $anketa->idOdgovor = $id;
    $anketa->obrisiOdgovor();
    return redirect()->back();
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška');
    }
}


public function dodajAnketu(Request $r){
    $r->validate([
     'pitanje' => 'required|min:5'
    ]);
    $anketa = new Anketa();
    $anketa->pitanje = $r->get('pitanje');

    try{
     $anketa->dodajAnketu();
     return redirect()->back()->with('success', 'Uspešno ste dodali anketu');
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
    }
}




public function izmeniAnketu(Request $r, $id){
    $r->validate([
     'pitanje' => 'required|min:5'
    ]);
    $anketa = new Anketa();
    $anketa->pitanje = $r->get('pitanje');
    try{
      $anketa->idAnketa = $id;
      $anketa->izmeniAnketu();
     return redirect()->back()->with('success', 'Uspešno ste izmenili anketu');
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška, pokušajte kasnije');

    }
}




public function izbrisiAnketu($id){
    $anketa = new Anketa();
    try{
    $anketa->idAnketa = $id;
    $anketa->izbrisiAnketu();
    $anketa->obrisiOdgovoreAnkete();
    return redirect()->back();
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
    }
}




public function podesiAktivnu(Request $r){
    $anketa = new Anketa();
    $aktivnaId = $r->get('activeList');
    try{
    $anketa->idAnketa = $aktivnaId;

    $anketa->podesiAktivnu();
    return redirect()->back();
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
    }
}



public function prikaziOdgovore($id){
    $anketa = new Anketa();
    try{
    $anketa->idAnketa = $id;
    $odgovori = $anketa->sviOdgovori();
    return response($odgovori, 200);
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return response(null, 500);
    }
}




public function dodajOdgovor(Request $r){
    $r->validate([
    'odgovorPlus' => 'required',
    'activeList' => 'required'
    ]);
    $anketa = new Anketa();
    $idAnketa = $r->get('activeList');
    $anketa->idAnketa = $idAnketa;
    $odgovori = explode(';', $r->get('odgovorPlus'));
    try{
    foreach($odgovori as $o){
    $anketa->odgovor = $o;
    $anketa->dodajOdgovor();
    }
    return redirect()->back()->with('success', 'Dodali ste odgovore');
    }
    catch(\Exception $ex){
    \Log::error('Desila se greska: '.$ex->getMessage());
    return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
    }
}




}

