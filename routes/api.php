<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::delete('/photo/delete/{id}','PhotoController@delete');
//Route::get('/photo/create','PhotoController@create');
//Route::post('/photo/post','PhotoController@loadImg');
Route::get('/photo','PhotoController@showall');

Route::get('/photo/{id}','PhotoController@showid');



//Route::get('photos', 'PhotoController@index');