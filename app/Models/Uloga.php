<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;


class Uloga
{
    public $id;
    public $naziv;


    public function getAll(){
    	$rezultat = DB::table('uloga')->get();

    	return $rezultat;
    }


    public function get(){
    	return DB::table('uloga')
    	       ->select('*')
    	       ->where('id', $this->id)
    	       ->first();
    }


    public function save(){
    	return DB::table('uloga')
    	       ->insert([
                  'naziv' => $this->naziv
    	       ]);
    }



    public function update(){
    	return DB::table('uloga')
    	       ->where('id', $this->id)
    	       ->update([
                  'naziv' => $this->naziv
    	       ]);
    }


    public function delete(){
    	return DB::table('uloga')
    	       ->where('id', $this->id)
    	       ->delete();
    }


}
