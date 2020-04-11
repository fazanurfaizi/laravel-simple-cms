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

Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\DashboardController@index');

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
