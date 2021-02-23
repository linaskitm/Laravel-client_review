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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store', 'ReviewController@store');
Route::post('/storeratings', 'ReviewController@storeRating');
Route::post('/storegender', 'ReviewController@storeGender');


Route::get('/', 'ReviewController@index');

Route::get('/search', 'ReviewController@searchBar');
Route::get('/displayrate', 'ReviewController@displayByRate');

Route::get('/delete/{review}', 'ReviewController@delete');

