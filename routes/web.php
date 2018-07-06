<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontendController@index');

Route::get('/autor','FrontendController@show');

//Logovanje
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');

//Oglasi
Route::group(['middleware' => 'korisnik'], function() {
  Route::get('/oglasi/create', 'OglasController@create');
  Route::post('/oglasi/store', 'OglasController@store');
});
Route::get('/oglasi/{id}','FrontendController@getOglas');


//Register
Route::get('/register','RegisterController@registerView')->name('registerView');
Route::post('/registerUser','RegisterController@registerUser')->name('registerUser');



//search
Route::get('/', 'FrontendController@search')->name('search');


//anketa ajax
Route::get('/anketa','AjaxController@index')->name('go');
Route::get('/ankete/rezultati', 'AjaxController@prikaziRezultate')->name('prikaziRezultate');
Route::post('/anketa/dodajGlas', 'AjaxController@dodajGlas');


Route::group(['middleware' => 'admin'], function() {

//Editovanje oglasa
Route::get('/all', 'OglasController@index'); 
Route::get('/oglasi', 'OglasController@show'); 
Route::get('/oglasi/edit/{id}', 'OglasController@edit');
Route::post('/oglasi/edit/store', 'OglasController@store');
Route::post('/oglasi/edit/update/{id}','OglasController@update');
Route::get('/oglasi/destroy/{id}','OglasController@destroy');
Route::get('/oglasi/approve/{id}','OglasController@approve');


//Editovanje korisnika
Route::get('/users/{id?}', 'KorisnikController@show');
Route::post('/users/store', 'KorisnikController@store');
Route::post('/users/update/{id}', 'KorisnikController@update');
Route::get('/users/destroy/{id}', 'KorisnikController@destroy');

// Upravljanje ulogama
Route::get('/roles/{id?}', 'UlogaController@show');
Route::post('/roles/store', 'UlogaController@store');
Route::post('/roles/update/{id}','UlogaController@update');
Route::get('/roles/destroy/{id}','UlogaController@destroy');

//meni
Route::get('/meni/{id?}', 'MeniController@show');
Route::post('/meni/store', 'MeniController@store');
Route::post('/meni/update/{id}','MeniController@update');
Route::get('/meni/destroy/{id}','MeniController@destroy');

//ankete
Route::get('/ankete/{id?}', 'AnketaController@index')->name('admin');
Route::get('/ankete/odgovor/{id?}', 'AnketaController@izmenaOdgovora')->name('izmenaOdgovora');
Route::get('/ankete/odgovor/brisi/{id}', 'AnketaController@obrisiOdgovor')->name('obrisiOdgovor');
Route::post('/ankete/dodajAnketu', 'AnketaController@dodajAnketu')->name('dodajAnketu');
Route::post('/ankete/izmeniAnketu/{id}', 'AnketaController@izmeniAnketu')->name('izmeniAnketu');
Route::post('/ankete/podesiAktivnu', 'AnketaController@podesiAktivnu')->name('podesiAktivnu');
Route::post('/ankete/prikaziOdgovore/{id}', 'AnketaController@prikaziOdgovore')->name('prikaziOdgovore');
Route::post('/ankete/dodajOdgovor', 'AnketaController@dodajOdgovor')->name('dodajOdgovor');
Route::get('/ankete/izbrisiAnketu/{id}', 'AnketaController@izbrisiAnketu')->name('izbrisiAnketu');

});