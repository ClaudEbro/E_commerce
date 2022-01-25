<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ClientController@home');
Route::get('/shop', 'ClientController@shop');
Route::get('/panier', 'ClientController@panier');
Route::get('/paiement','ClientController@paiement');
Route::get('/client_login','ClientController@client_login');
Route::get('/signup','ClientController@signup');
Route::get('/select_par_cat/{name}', 'ClientController@select_par_cat');
Route::get('/ajouter_au_panier/{id}','ClientController@ajouter_au_panier');
Route::post('/modifier_qty/{id}','ClientController@modifier_panier');
Route::get('/retirer_produit/{id}','ClientController@retirer_produit');
Route::post('/payer','ClientController@payer');
Route::post('/creer_compte','ClientController@creer_compte');
Route::post('/acceder_compte', 'ClientController@acceder_compte');


Route::get('/voir_pdf/{id}', 'PdfController@voir_pdf');

Route::get('/admin','AdminController@dashboard');
Route::get('/commandes','AdminController@commandes');

Route::get('/ajoutercategorie', 'CategoryController@ajoutercategorie');
Route::post('/sauvercategorie','CategoryController@sauvercategorie');
Route::get('/categories','CategoryController@categories');
Route::get('/edit_categorie/{id}', 'CategoryController@edit_categorie');
Route::post('/modifiercategorie','CategoryController@modifiercategorie');
Route::get('/supprimercategorie/{id}','CategoryController@supprimercategorie'); 

Route::get('/ajouterproduit', 'ProductController@ajouterproduit');
Route::post('/sauverproduit','ProductController@sauverproduit');
Route::get('/produits','ProductController@produits');
Route::get('/edit_produit/{id}', 'ProductController@edit_produit');
Route::post('/modifierproduit','ProductController@modifierproduit');
Route::get('/supprimerproduit/{id}','ProductController@supprimerproduit');
Route::get('/activer_produit/{id}','ProductController@activerproduit');
Route::get('/desactiver_produit/{id}','ProductController@desactiverproduit');
Route::post('/modifier_produit/{id}','ProductController@modifier_panier');

Route::get('/ajouterslider', 'SliderController@ajouterslider');
Route::post('/sauverslider','SliderController@sauverslider');
Route::get('/sliders','SliderController@sliders');
Route::get('edit_slider/{id}','SliderController@edit_slider');
Route::post('/modifierslider','SliderController@modifierslider');
Route::get('supprimerslider/{id}','SliderController@supprimerslider');
Route::get('desactiver_slider/{id}','SliderController@desactiver_slider');
Route::get('activer_slider/{id}','SliderController@activer_slider');


