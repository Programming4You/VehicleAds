<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;

class Meni
{

    public $id;
    public $naziv;
    public $link;


    public function getAll(){
        $rezultat = DB::table('meni')->get();
        return $rezultat;
    }


    public function get() {
		$rezultat = DB::table('meni')
					->select('*')
					->where('id',$this->id)
					->first();
		return $rezultat;
	}


   public function save(){
     
     $rezultat = DB::table('meni')->insert([
        'naziv' => $this->naziv,
        'link' => $this->link
     ]);
      return $rezultat;
    }



  public function update(){
       $data = [
          'naziv' => $this->naziv,
          'link' => $this->link,
       ];

		$rezultat = DB::table('meni')
		           ->where('id',$this->id)
				   ->update($data);
				
		return $rezultat;

    }



      public function delete(){
    	$rezultat = DB::table('meni')
    	            ->where('id', $this->id)
    	            ->delete();

    	      return $rezultat;
    }

}
