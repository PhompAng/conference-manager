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
        'as' => 'setRole',
        'uses' => 'UsersController@setRole'
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

        Route::get('/{paper_id}/author_review', [
            'as' => 'author_review.index',
            'uses' => 'Author\ReviewController@index'
        ]);
    });

    Route::group(['middleware' => 'can:reviewer'], function() {
        Route::get('/review_list', 'PaperListController@reviewList');
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
        Route::get('/papers', 'TPC\PapersController@index');
        Route::get('/author', 'TPC\AuthorController@index');
        Route::get('/reviewer', 'TPC\ReviewerController@index');
        Route::post('/{id}/tpc', 'Reviewer\UsersController@makeTPC');
        Route::delete('/{id}/tpc', 'Reviewer\UsersController@removeTPC');
        Route::post('/papers/{paper_id}/decision', [
            'as' => 'paper.accepted',
            'uses' => 'TPC\PapersController@accepted'
        ]);
        Route::delete('/papers/{paper_id}/decision', [
            'as' => 'paper.rejected',
            'uses' => 'TPC\PapersController@rejected'
        ]);
        Route::post('/papers/{paper_id}/notify', [
            'as' => 'paper.notify',
            'uses' => 'TPC\PapersController@notify'
        ]);
    });

    Route::group(['middleware' => 'can:reviewer,tpc'], function () {
        Route::get('/{paper_id}/review', [
            'as' => 'review.index',
            'uses' => 'Reviewer\ReviewController@index'
        ]);
    });
    Route::get('/my_submission', 'PaperListController@mySubmission');
    Route::get('/{user_id}/{file}', [
        'as' => 'getPaper',
        'uses' => 'ViewPaperController@getPaper'
    ]);
});
