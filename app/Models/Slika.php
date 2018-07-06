<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;


class Slika {

	public $id;
	public $alt;
	public $putanja;

	public function save(){
		$id = DB::table('slika')
				->insertGetId([
					'alt' => $this->alt,
					'putanja' => $this->putanja
				]);
		return $id;
    }
    


	public function get() {
		$rezultat = DB::table('slika')
					->select('*','slika.id')
					->where('id',$this->id)
					->first();
		return $rezultat;
    }
    

    public function update(){
	
		$data = [
			'alt' => $this->alt
		];
		
		if(!empty($this->putanja)){ 
			$data['putanja'] = $this->putanja;
		}

		$rez = DB::table('slika')
		->where('id',$this->id)
				->update($data);
		return $rez;
    }
    

    public function delete(){
		$rezultat = DB::table('slika')
		            ->join('oglas','oglas.slika_id','=','slika.id')
					->where('oglas.slika_id', $this->id)
					->delete();
		return $rezultat;
	}


}