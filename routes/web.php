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

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======


// Block_stock



Route::get('/stock', function () {
    return view('welcome');
});
Route::get('/stock/edit', function () {
    return view('welcome');
});
Route::get('/stock/new', function () {
    return view('welcome');
});
>>>>>>> add routes
