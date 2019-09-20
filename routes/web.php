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

Route::get('/admin', function () {
    return view('admin');
});
Auth::routes();


Route::resource('panier', 'BasketController');
// Block_stock

Route::get('/admin/stock','StockController@show')->name("stock");

Route::get('/admin/stock/ajouter','StockController@add')->name("stockAdd");
Route::get('/admin/stock/ajouter/valider','StockController@validAdd')->name("validStockAdd");

Route::get('/admin/stock/supprimer','StockController@delete')->name("stockDelete");
Route::get('/admin/stock/modifier','StockController@edit')->name("stockEdit");

Route::get('/admin/stock/modifier/valider','StockController@validEdit')->name("validStockEdit");

Route::resource('/admin/bags','BagsController');


