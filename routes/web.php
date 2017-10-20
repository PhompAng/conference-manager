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
    Route::get('/edit', 'UserEditController@index');
    Route::post('/edit', 'UserEditController@update');
    Route::group(['middleware' => 'can:author'], function () {
        Route::resource('/paper', 'Author\PaperController');
        Route::resource('/{paper_id}/camera_ready', 'Author\CameraReadyController', ['only' => ['create', 'store']]);
        Route::get('/camera_ready', [
            'as' => 'camera_ready.index',
            'uses' => 'Author\CameraReadyController@index'
        ]);
    });

    Route::group(['middleware' => 'can:reviewer'], function() {
        Route::resource('/{paper_id}/review', 'Reviewer\ReviewController');
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

    Route::get('/{paper_id}/review', [
        'as' => 'review.index',
        'uses' => 'Reviewer\ReviewController@index'
    ]);
    Route::get('/list', 'PaperListController@index');
    Route::get('/{user_id}/{file}', [
        'as' => 'getPaper',
        'uses' => 'ViewPaperController@getPaper'
    ]);
});
