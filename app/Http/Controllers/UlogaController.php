<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uloga;
use App\Models\Meni;


class UlogaController extends Controller
{
    private $data = [];


    public function __construct(){
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
            'naziv' => [
                'required', 'unique:uloga'
            ]
        ], [
            'required' => 'Polje :attribute je obavezno',
            'unique' => 'Polje :attribute mora biti jedinstveno u bazi.'
        ]);

        $naziv = $request->get('naziv');

        $uloga = new Uloga();
        $uloga->naziv = $naziv;

        $rez = $uloga->save();

        if($rez == 1){
            return redirect()->back()->with('success', 'Dodata uloga!');
        }
        else {
            return redirect()->back()->with('error','Greska pri dodavanju uloge!');
        }
    }


    public function show($id = null)
    {
        $uloga = new Uloga();
        $this->data['roles'] = $uloga->getAll();

        If(!empty($id)){
            $uloga->id = $id;
            $this->data['updateRole'] = $uloga->get();
        }
       return view('pages.createUloga', $this->data);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $naziv = $request->get('naziv');

        $uloga = new Uloga();
        $uloga->id = $id;
        $uloga->naziv = $naziv;

        $rez = $uloga->update();

        if($rez == 1){
            return redirect()->back()->with('success', 'Azurirana uloga!');
        }
        else {
            return redirect()->back()->with('error','Greska pri azuriranju uloge!');
        }
    }

   
    public function destroy($id)
    {
        $uloga = new Uloga();
        $uloga->id = $id;
        $rez = $uloga->delete();

        if($rez == 1){
            return redirect()->back()->with('success', 'Obrisana uloga!');
        }
        else {
            return redirect()->back()->with('error','Greska pri brisanju uloge!');
        }
    }
}
