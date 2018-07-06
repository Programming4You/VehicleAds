<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class Oglas{
    
    public $id;
	public $naslov;
	public $sadrzaj;
	public $korisnik_id;
	public $slika_id;
	public $approved;


	public function getAll(){
		$rezultat = DB::table('oglas')
					->select('*','oglas.id')
					->join('slika','oglas.slika_id','=','slika.id')
					->join('korisnik','oglas.korisnik_id','=','korisnik.id')
					->where('oglas.approved','=', 1)
					->orderBy('oglas.created_at','desc')
					->paginate(3);
		return $rezultat;
	}


	public function getAllAdmin(){
		$rezultat = DB::table('oglas')
					->select('*','oglas.id')
					->join('slika','oglas.slika_id','=','slika.id')
					->join('korisnik','oglas.korisnik_id','=','korisnik.id')
					->orderBy('oglas.created_at','desc')
					->paginate(3);
		return $rezultat;
	}



    public function get() {
		$rezultat = DB::table('oglas')
					->select('*','oglas.id')
					->join('slika','oglas.slika_id','=','slika.id')
					->where('oglas.id',$this->id)
					->first();
		return $rezultat;
	}



    public function getOg($id) {
		$rezultat = DB::table('oglas')
					->select('*','oglas.id')
					->join('slika', 'oglas.slika_id','=','slika.id')
					->where('oglas.id',$id)
					->first();
		return $rezultat;
	}



	public function save() {
		$rezultat = DB::table('oglas')->insert([
			'naslov' => $this->naslov,
			'sadrzaj' => $this->sadrzaj,
			'korisnik_id' => $this->korisnik_id,
			'created_at' => time(),
			'slika_id' => $this->slika_id,
			'approved' => $this->approved
		]);
		return $rezultat;
	}

	public function update(){
		return DB::table('oglas')
			->where('id', $this->id)
			->update([
				'naslov' => $this->naslov,
				'sadrzaj' => $this->sadrzaj
			]);
	}


	public function delete(){
		$rezultat = DB::table('oglas')
					->where('id', $this->id)
					->delete();
		return $rezultat;
	}




   public function search(){
    
        $result = DB::table('oglas')
            	->select('*','oglas.id')
				->join('slika','oglas.slika_id','=','slika.id')
				->join('korisnik','oglas.korisnik_id','=','korisnik.id')
				->where([
				    ['naslov', 'like', '%' . Input::get('naslov') . '%'],
				    ['oglas.approved','=', 1]
				])
			    ->orderBy('oglas.created_at','desc')
		     	->paginate(3);
	
        return $result;
   }





	public function odobri(){
		return DB::table('oglas')
			->where('id', $this->id)
			->update([
				'approved' => 1
			]);
	}



}
