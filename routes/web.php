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
        Route::delete('/delete/{id}', 'Admin\NewsController@destroy');
    });

});
