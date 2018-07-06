<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Oglas;



class FrontendController extends Controller
{
    private $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }


  public function index(){
      $oglas = new Oglas();
        try{
        $this->data['oglasi'] = $oglas->getAll();
          return view('pages.home', $this->data);
        }
        catch(\Exception $ex){
           \Log::error('Desila se greska: '.$ex->getMessage());
           return redirect()->back()->with('error', 'Desila se greska, pokusajte kasnije');
        }
    }


    public function getOglas($id){
        $oglas = new Oglas();
        $this->data['singleOglas'] = $oglas->getOg($id);
        return view('pages.oglas', $this->data);
    }


    public function show(){

        return view('pages.autor', $this->data);
    }



     public function search(){
         $oglas = new Oglas();
         $this->data['oglasi'] = $oglas->search();
         return view('pages.home', $this->data);
        }
   


}
