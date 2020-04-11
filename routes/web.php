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
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\DashboardController@index');

    Route::group(['prefix' => 'layanan-publik'], function () {
        Route::get('/', 'Admin\PublikController@index');
        Route::get('/json', 'Admin\PublikController@json');
        Route::get('/create', 'Admin\PublikController@create');
        Route::post('/store', 'Admin\PublikController@store');
        Route::get('/edit/{id}', 'Admin\PublikController@edit');
        Route::put('/update/{id}', 'Admin\PublikController@update');
        Route::get('/delete/{id}', 'Admin\PublikController@destroy');
    });

    Route::group(['prefix' => 'layanan-hukum'], function () {
        Route::get('/', 'Admin\HukumController@index');
        Route::get('/json', 'Admin\HukumController@json');
        Route::get('/create', 'Admin\HukumController@create');
        Route::post('/store', 'Admin\HukumController@store');
        Route::get('/edit/{id}', 'Admin\HukumController@edit');
        Route::put('/update/{id}', 'Admin\HukumController@update');
        Route::get('/delete/{id}', 'Admin\HukumController@destroy');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Admin\NewsController@index');
        Route::get('/json', 'Admin\NewsController@json');
        Route::get('/create', 'Admin\NewsController@create');
        Route::post('/store', 'Admin\NewsController@store');
        Route::get('/edit/{id}', 'Admin\NewsController@edit');
        Route::put('/update/{id}', 'Admin\NewsController@update');
        Route::get('/delete/{id}', 'Admin\NewsController@destroy');
    });

    Route::group(['prefix' => 'features'], function () {
        Route::get('/', 'Admin\FeaturesController@index');
        Route::get('/json', 'Admin\FeaturesController@json');
        Route::get('/create', 'Admin\FeaturesController@create');
        Route::post('/store', 'Admin\FeaturesController@store');
        Route::get('/edit/{id}', 'Admin\FeaturesController@edit');
        Route::put('/update/{id}', 'Admin\FeaturesController@update');
        Route::get('/delete/{id}', 'Admin\FeaturesController@destroy');
    });

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'Admin\BlogsController@index');
        Route::get('/json', 'Admin\BlogsController@json');
        Route::get('/create', 'Admin\BlogsController@create');
        Route::post('/store', 'Admin\BlogsController@store');
        Route::get('/edit/{id}', 'Admin\BlogsController@edit');
        Route::put('/update/{id}', 'Admin\BlogsController@update');
        Route::get('/delete/{id}', 'Admin\BlogsController@destroy');
    });

});
