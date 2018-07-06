<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;

class MeniController extends Controller
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
                'required', 'unique:meni'
            ]
        ], [
            'required' => 'Polje :attribute je obavezno',
            'unique' => 'Polje :attribute mora biti jedinstveno u bazi.'
        ]);

        $naziv = $request->get('naziv');
        $link = $request->get('link');

        $meni = new Meni();
        $meni->naziv = $naziv;
        $meni->link = $link;

        $rez = $meni->save();

        if($rez == 1){
            return redirect()->back()->with('success', 'Dodat meni!');
        }
        else {
            return redirect()->back()->with('error','Greska pri dodavanju menija!');
        }
    }


    public function show($id = null)
    {
        $meni = new Meni();
        $this->data['meni'] = $meni->getAll();

          If(!empty($id)){
            $meni->id = $id;
            $this->data['updateMeni'] = $meni->get();
        }

       return view('pages.createMeni', $this->data);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $naziv = $request->get('naziv');
        $link = $request->get('link');

        $meni = new Meni();
        $meni->id = $id;
        $meni->naziv = $naziv;
        $meni->link = $link;

        $rez = $meni->update();

        if($rez == 1){
            return redirect()->back()->with('success', 'Azuriran meni!');
        }
        else {
            return redirect()->back()->with('error','Greska pri azuriranju menija!');
        }
    }

   
    public function destroy($id)
    {
        $meni = new Meni();
        $meni->id = $id;
        $rez = $meni->delete();

        if($rez == 1){
            return redirect()->back()->with('success', 'Obrisan meni!');
        }
        else {
            return redirect()->back()->with('error','Greska pri brisanju menija!');
        }
    }


}
