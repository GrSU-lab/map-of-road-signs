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

Route::get('/photo','PhotoController@showall');
Route::post('/lights/post','TrafficLightController@store');
Route::post('/lights/change','TrafficLightController@change');
Route::delete('/photo/delete/{id}','TrafficLightController@delete');
Route::get('/photo/{id}','TrafficLightController@showid');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
