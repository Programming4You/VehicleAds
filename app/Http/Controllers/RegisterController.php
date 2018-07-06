<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Korisnik;
use Validator;


class RegisterController extends Controller
{

    private $data=[];

    public function __construct() {
        $meni=new Meni();
        $this->data['menus']=$meni->getAll();

    }


    public function registerView(){

        return view ('pages.register', $this->data);

    }


    public function registerUser(Request $request){

      
		 $validate = [
		'tbKorisnickoImeRegistracija' => 'required|alpha_num|min:3|max:15|unique:korisnik,korisnicko_ime',
		'tbLozinkaRegistracija' => 'required|min:4|max:15|alpha_num',
		];
		$customMessages = [
		'required' => 'Polje :attribute je obavezno',
		'alpha_num' => 'Polje :attribute dozvoljava samo slova i brojeve',
		'min' => 'Polje :attribute mora sadržati najmanje :min karaktera',
		'max' => 'Polje :attribute može sadržati najviše :max karaktera',
		'unique' => 'Korisnicko ime vec postoji!'
		];
		$request->validate($validate, $customMessages);
    


		$korisnickoIme = $request->get('tbKorisnickoImeRegistracija');
		$lozinka = $request->get('tbLozinkaRegistracija');

      
		$korisnik = new Korisnik();
		$korisnik->korisnicko_ime = $korisnickoIme;
		$korisnik->lozinka = $lozinka;
		$korisnik->uloga_id = 2;

         try{
         	$korisnik->regUser();
		
             return redirect()->back()->with('success', 'Uspšno ste se registrovali, sada se možete prijaviti');
	     }
         catch(\Exception $ex){
			\Log::error("Greska: ".$ex->getMessage());
			return redirect()->back()->with('error', 'Desila se greška na serveru, pokušajte kasnije');
		}

    }
    
}
