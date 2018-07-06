<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Oglas;
use App\Models\Slika;
use App\Models\Korisnik;
use Validator;
use Illuminate\Support\Facades\File;



class OglasController extends Controller
{
    private $data = [];

    public function __construct(){
    	$meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }


  public function index(){
        $oglas = new Oglas();
        try{
          $this->data['oglasi'] = $oglas->getAllAdmin();
          return view('pages.home', $this->data);
        }
        catch(\Exception $ex){
           \Log::error('Desila se greska: '.$ex->getMessage());
           return redirect()->back()->with('error', 'Desila se greska, pokusajte kasnije');
        }
    }


    public function create()
    {
        return view('pages.createOglas', $this->data);
    }


    public function store(Request $request)
    {

            $rules = [
                'title' => ['regex:/^[a-z|A-Z|0-9|\s]*$/'],
                'body' => 'required',
                'photo' => 'required|mimes:jpg,jpeg,png,gif|max:3000',
                'alt' => 'required'
            ];
            $custom_messages = [
                'required' => 'Polje :attribute je obavezno!',
                'title.regex' => 'Polje naslov nije u ispravnom formatu!',
                'max' => 'Fajl ne sme biti veci od :max KB.',
                'mimes' => 'Dozvoljeni formati su: :values.'
            ];
            $request->validate($rules, $custom_messages);
            
    
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $tmp_path = $photo->getPathName();
            
            $folder = 'images/';
            $file_name = time().".".$extension;
            $new_path = public_path($folder).$file_name;
    
            try {
                move_uploaded_file($tmp_path, $new_path);
    
                $slika = new Slika();
                $slika->alt = trim($request->get('alt'));
                $slika->putanja = 'images/'.$file_name;
                $slika_id = $slika->save();

                $korisnik = new Korisnik();
                $idKorisnik = session('user')[0]->id;
                $korisnik->id = $idKorisnik;
                $idKorisnika = $korisnik->id;
    
                $oglas = new Oglas();
                $oglas->naslov = $request->get('title');
                $oglas->sadrzaj = $request->get('body');
                $oglas->korisnik_id = $idKorisnika;
                $oglas->slika_id = $slika_id;
                $oglas->approved = 0;
                $oglas->save();
    
                return redirect('/')->with('success','Oglas sa slikom ce biti dodat nakon odobrenja!');
            }
            catch(\Illuminate\Database\QueryException $ex){ // greske u upitu
                \Log::error($ex->getMessage());
                return redirect()->back()->with('error','Greska pri dodavanju oglasa u bazu!');
            }
            catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { 
                \Log::error('Problem sa fajlom!! '.$ex->getMessage());
                return redirect()->back()->with('error','Greska pri dodavanju slike!');
            }
            catch(\ErrorException $ex) { 
                \Log::error('Problem sa fajlom!! '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
            } 
        }
    

 



    public function show()
    {
        $oglas = new Oglas();
        $this->data['oglasi'] = $oglas->getAll();
        

		return view('pages.oglasi', $this->data);
    }


 
    public function edit($id)
    {
        $oglas = new Oglas();
        $oglas->id = $id;
        $this->data['oglasi'] = $oglas->get();
        
     
       
		return view('pages.editOglas', $this->data);
    }

  
    public function update(Request $request, $id){
     
        $naslov = $request->get('title');
        $sadrzaj = $request->get('body');
        $alt = $request->get('alt');

        $putanja = $request->file('photo');
		
		
        $slika = new Slika();
        $slika->id = $id;
        $slika->alt = $alt;
        

        $oglas = new Oglas();
        $oglas->id = $id;
        $oglas->naslov = $naslov;
        $oglas->sadrzaj = $sadrzaj;

        //$oglas->slika_id = $slika_id;
        //$oglas->update();


		if(!empty($putanja)){ // ako je uploadovana slika
			
			// brisanje stare slike sa servera 
			$slika_to_update = $slika->get();
			File::delete($slika_to_update->putanja);

			// upload nove slike 
			$tmp_putanja = $putanja->getPathName();
			$ime_fajla = time().'.'.$putanja->getClientOriginalExtension();
			$path = 'images/'.$ime_fajla;
			$putanja_server = public_path($path);

			File::move($tmp_putanja, $putanja_server);

			$slika->putanja = $path;
		}
        
        $rezS = $slika->update();
		$rez = $oglas->update();
		
		if($rez == 1 || $rezS == 1){ // ako je uspeo update
			return redirect('/oglasi')->with('message','Uspesan update!');
		}
		else {
			return redirect('/oglasi')->with('message','Greska pri update-u!');
		}

         
     
    }

  
    public function destroy($id)
    {
        $oglas = new Oglas();
        $slika = new Slika();
        $slika->id = $id;
		$oglas->id = $id;

		// brisanje stare slike sa servera 
		$slika_to_delete = $slika->get();
		File::delete($slika_to_delete->putanja);
        //\File::delete(public_path($slika_to_delete->putanja));
        //unlink($slika_to_delete->putanja);
      
		$rez = $oglas->delete();
        $slika->delete();

		if($rez == 1){
            return redirect()->back()->with('message','Uspesan delete!');
		}
		else {
			return redirect()->back()->with('message','Greska pri delete-u!');
		}
    }




    public function approve($id)
    {
        $oglas = new Oglas();
        $oglas->id = $id;
      
        $rez = $oglas->odobri();

        if($rez == 1){
            return redirect('/all')->with('message','Uspesno odobren!');
        }
        else {
            return redirect('/all')->with('message','Greska pri odobravanju!');
        }
    }




}
