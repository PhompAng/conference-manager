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
//    Auth::routes();
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::resource('/admin', 'AdminController');
    Route::resource('/', 'ConferenceController', ['parameters' => [
        '' => 'id'
    ]]);
    Route::resource('/{conf}/user', 'UsersController');
    Route::post('/{conf}/{id}/tpc', [
        'as' => 'makeTPC',
        'uses' => 'UsersController@makeTPC'
    ]);
    Route::delete('/{conf}/{id}/tpc', [
        'as' => 'removeTPC',
        'uses' => 'UsersController@removeTPC'
    ]);
});

Route::group(['prefix' => '{url}'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index');
    Route::group(['middleware' => 'can:author'], function () {
        Route::get('/edit', 'Author\EditController@index');
        Route::post('/edit', 'Author\EditController@update');
        Route::resource('/paper', 'Author\PaperController');
    });

    Route::group(['middleware' => 'can:reviewer'], function() {
        Route::get('/review/{paper_id}', [
            'as' => 'review.index',
            'uses' => 'Reviewer\ReviewController@index'
        ]);
        Route::post('/review/{paper_id}/{user_id}/assign', [
            'as' => 'review.assign',
            'uses' => 'Reviewer\ReviewController@assign'
        ]);
        Route::delete('/review/{paper_id}/{user_id}/assign', [
            'as' => 'review.unassign',
            'uses' => 'Reviewer\ReviewController@unassign'
        ]);
    });

    Route::group(['middleware' => 'can:tpc'], function () {
        Route::get('/author', 'TPC\AuthorController@index');
        Route::get('/reviewer', 'TPC\ReviewerController@index');
        Route::post('/{id}/tpc', 'Reviewer\UsersController@makeTPC');
        Route::delete('/{id}/tpc', 'Reviewer\UsersController@removeTPC');
    });

    Route::get('/list', 'PaperListController@index');
    Route::get('/{user_id}/{file}', [
        'as' => 'getPaper',
        'uses' => 'ViewPaperController@getPaper'
    ]);
});
