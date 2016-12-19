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
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Auth::routes();
    Route::resource('/', 'ConferenceController', ['parameters' => [
        '' => 'id'
    ]]);
});

Route::group(['prefix' => '{url}'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index');
    Route::group(['middleware' => 'can:author'], function () {
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

    Route::group(['middleware' => 'can:reviewer'], function() {
    });
});
