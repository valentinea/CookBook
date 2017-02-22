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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/about', function(){ return view('about');});

Route::get('/home', 'HomeController@index');

Route::get('/home/pretraga', 'HomeController@pretrazi');

Route::get('/moji_recepti', function(){ return view('mojiRecepti');
    });

Route::get('/moji_recepti/{id}', 'HomeController@pogledajRecept');

Route::get('/recepti/{id}', 'HomeController@pogledajRecept');

Route::post('/recepti/{id}/komentiraj', 'Recipes@dodajKomentar');

Route::get('/new', function(){ return view('newRecipe');});

//ne radi ako stavim /moji_recepti/new????
Route::post('/new/next', 'CreateRecipe@dodajRecept');

//Route::get('new/next', function(){ return view('newRecipe2');});
//???
Route::post('/new/{id}/ingredients', 'CreateRecipe@dodajSastojak');

Route::get('/new/{id}/ingredients', function(){ return view('newRecipe2');});

Route::post('/new/{id}/text', 'CreateRecipe@prijedi');

Route::post('/new/{id}/text/add', 'CreateRecipe@dodajText');

Route::get('/najdrazi_recepti', 'HomeController@najdraziRecepti');

Route::get("/recept/{id}/delete", 'Recipes@obrisiRecept');

Route::get('/recept/{id}/like', 'Recipes@lajk');



Auth::routes();

Route::get('/home', 'HomeController@index');
