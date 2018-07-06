<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anketa;
use App\Models\Meni;


class AjaxController extends Controller
{

  private $data=[];


    public function __construct() {
        $meni=new Meni();
        $this->data['menus']=$meni->getAll();
    }



	public function index(){
		$anketa = new Anketa();
		try{
		$this->data['anketa'] = $anketa->aktivna();
		$this->data['odgovori'] = $anketa->odgovori();
		return view('pages.anketa', $this->data);
		}
		catch(\Exception $ex){
		\Log::error('Desila se greska: '.$ex->getMessage());
		return redirect()->back()->with('error', 'Desila se greska, pokusajte kasnije');
}
}


    
	public function dodajGlas(Request $r){

	$idOdgovor = $r->get('odgovor');
	if($idOdgovor == null){
	return response('Izaberite odgovor');
	}
	else{
	$anketa = new Anketa();
	$idKorisnik = session('user')[0]->id;
	$anketa->idKorisnik = $idKorisnik;
	try{
	$idAktivna = $anketa->aktivna()->idAnketa;
	$anketa->idAktivna = $idAktivna;
	$provera = $anketa->proveraGlasanja();
	if($provera != null){
	return response("Vec ste glasali", 200);
	}
	else{
	$anketa->idOdgovor = $idOdgovor;
	$anketa->dodajGlas();
	$anketa->azurirajRezultate();
	return response("Hvala sto ste glasali", 200);

	}
	}
	catch(\Exception $ex){
	\Log::error('Greska: '.$ex->getMessage());
	return response('Greska na serveru', 500);
	}
	}
}



     public function prikaziRezultate(){
        $anketa = new Anketa();
        $rezultat = $anketa->rezultati();
        return $rezultat;

    }



}
