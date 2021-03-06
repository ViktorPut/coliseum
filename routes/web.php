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


Auth::routes();

Route::get('/', 'HousesController@index')->name('home');
Route::resource('/houses', 'HousesController', [ 'except' => 'index']);
Route::resource('/users',  'UsersController');

Route::get('/photos/{photo}/destroy', 'PhotosController@destroy');

//Route::post('photos/{house}/create', 'PhotosController@create');
