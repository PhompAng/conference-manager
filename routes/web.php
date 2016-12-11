<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::group(['prefix' => '{url}'], function () {
    Auth::routes();
    Route::get('/', 'Author\HomeController@index');
    Route::get('/edit', 'Author\EditController@index');
    Route::post('/edit', 'Author\EditController@update');
    Route::get('/paper', 'Author\PaperController@index');
    Route::post('/paper', 'Author\PaperController@submit');
    Route::get('/list', 'Author\PaperListController@index');

    Route::get('/{user_id}/{file}', [
        'as' => 'getPaper',
        'uses' => 'Author\PaperController@getPaper'
    ]);
});
