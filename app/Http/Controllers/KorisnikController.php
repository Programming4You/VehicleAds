<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uloga;
use App\Models\Korisnik;
use App\Models\Meni;
use Illuminate\Support\Facades\File;


class KorisnikController extends Controller
{

    private $data = [];


    public function __construct(){
        $uloga = new Uloga();
        $this->data['uloge'] = $uloga->getAll();

        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }

   
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
            $request->validate([
            'korisnickoIme' => 'unique:korisnik,korisnicko_ime|min:3|max:15',
            'lozinka' => 'required|min:4|max:15|alpha_num',
            'ddlUloga' => 'required|not_in:0',
            'slika' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        $korisnicko_ime = $request->get('korisnickoIme');
        $lozinka = $request->get('lozinka');
        $uloga_id = $request->get('ddlUloga');
        
        $slika = $request->file('slika');
        
        $tmp_putanja = $slika->getPathName(); 
        $ekstenzija = $slika->getClientOriginalExtension(); 
        $ime_fajla = time().'.'.$ekstenzija;
        $putanja = 'images/'.$ime_fajla;
        
        $putanja_server = public_path($putanja); 

        try {
            File::move($tmp_putanja, $putanja_server);

            $korisnik = new Korisnik();
            $korisnik->korisnicko_ime = $korisnicko_ime;
            $korisnik->lozinka = $lozinka;
            $korisnik->slika = $putanja;
            $korisnik->uloga_id = $uloga_id;

            $rez = $korisnik->save();
           
            if($rez == 1){
                return redirect()->back()->with('message','Uspesan unos!');
            }
            else {
                return redirect()->back()->with('message','Greska pri unosu!');
            }
        }
        catch (\Exception $ex){
            \Log::error('MOJA GRESKA: '.$ex->getMessage());
        }
    }

   
    public function show($id = null)
    {
        $korisnik = new Korisnik();
        $this->data['korisnici'] = $korisnik->getAll();

        if(!empty($id)){
            $korisnik->id = $id;
            $this->data['korisnik'] = $korisnik->get();
        }
        return view('pages.createKorisnik', $this->data);
    }

   
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

      $request->validate([
            'korisnickoIme' => 'min:3|max:15',
            'lozinka' => 'required|min:4|max:15|alpha_num',
            'ddlUloga' => 'required|not_in:0'
        ]);

        $korisnicko_ime = $request->get('korisnickoIme');
        $lozinka = $request->get('lozinka');
        $uloga_id = $request->get('ddlUloga');
        
        $slika = $request->file('slika');

        $korisnik = new Korisnik();
        $korisnik->id = $id;
        $korisnik->korisnicko_ime = $korisnicko_ime;
        $korisnik->lozinka = $lozinka;
        $korisnik->uloga_id = $uloga_id;

        if(!empty($slika)){ 
            
            $tmp_putanja = $slika->getPathName();
            $ime_fajla = time().'.'.$slika->getClientOriginalExtension();
            $putanja = 'images/'.$ime_fajla;
            $putanja_server = public_path($putanja);

            File::move($tmp_putanja, $putanja_server);

            $korisnik->slika = $putanja;
        }

        $rez = $korisnik->update();
        
        if($rez == 1){ 
            return redirect('/users')->with('message','Uspesan update!');
        }
        else {
            return redirect('/users')->with('message','Greska pri update-u!');
        }
    }

    
    public function destroy($id)
    {
        $korisnik = new Korisnik();
        $korisnik->id = $id;

        $rez = $korisnik->delete();
        if($rez == 1){
            return redirect('/users')->with('message','Uspesan delete!');
        }
        else{
            return redirect('/users')->with('message','Greska pri delete-u!');
        }
    }
}
