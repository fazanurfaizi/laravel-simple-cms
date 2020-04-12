<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', 'HomeController@index');

Route::get('create-symlink', function() {
    Artisan::call('storage:link');
});

Route::get('create-database', function() {
    Artisan::call('migrate');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\DashboardController@index');

    Route::group(['prefix' => 'layanan-publik'], function () {
        Route::get('/', 'Admin\PublikController@index');
        Route::get('/json', 'Admin\PublikController@json');
        Route::get('/create', 'Admin\PublikController@create');
        Route::post('/store', 'Admin\PublikController@store');
        Route::get('/edit/{id}', 'Admin\PublikController@edit');
        Route::put('/update/{id}', 'Admin\PublikController@update');
        Route::delete('/delete/{id}', 'Admin\PublikController@destroy');
    });

    Route::group(['prefix' => 'layanan-hukum'], function () {
        Route::get('/', 'Admin\HukumController@index');
        Route::get('/json', 'Admin\HukumController@json');
        Route::get('/create', 'Admin\HukumController@create');
        Route::post('/store', 'Admin\HukumController@store');
        Route::get('/edit/{id}', 'Admin\HukumController@edit');
        Route::put('/update/{id}', 'Admin\HukumController@update');
        Route::delete('/delete/{id}', 'Admin\HukumController@destroy');
    });

    Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'Admin\AboutController@index');
        Route::get('/json', 'Admin\AboutController@json');
        Route::get('/create', 'Admin\AboutController@create');
        Route::post('/store', 'Admin\AboutController@store');
        Route::get('/edit/{id}', 'Admin\AboutController@edit');
        Route::put('/update/{id}', 'Admin\AboutController@update');
        Route::delete('/delete/{id}', 'Admin\AboutController@destroy');
    });

    Route::group(['prefix' => 'information'], function () {
        Route::get('/', 'Admin\InformationController@index');
        Route::get('/json', 'Admin\InformationController@json');
        Route::get('/create', 'Admin\InformationController@create');
        Route::post('/store', 'Admin\InformationController@store');
        Route::get('/edit/{id}', 'Admin\InformationController@edit');
        Route::put('/update/{id}', 'Admin\InformationController@update');
        Route::delete('/delete/{id}', 'Admin\InformationController@destroy');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Admin\NewsController@index');
        Route::get('/json', 'Admin\NewsController@json');
        Route::get('/create', 'Admin\NewsController@create');
        Route::post('/store', 'Admin\NewsController@store');
        Route::get('/edit/{id}', 'Admin\NewsController@edit');
        Route::put('/update/{id}', 'Admin\NewsController@update');
        Route::delete('/delete/{id}', 'Admin\NewsController@destroy');
    });

    Route::group(['prefix' => 'features'], function () {
        Route::get('/', 'Admin\FeaturesController@index');
        Route::get('/json', 'Admin\FeaturesController@json');
        Route::get('/create', 'Admin\FeaturesController@create');
        Route::post('/store', 'Admin\FeaturesController@store');
        Route::get('/edit/{id}', 'Admin\FeaturesController@edit');
        Route::put('/update/{id}', 'Admin\FeaturesController@update');
        Route::delete('/delete/{id}', 'Admin\FeaturesController@destroy');
    });

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'Admin\BlogsController@index');
        Route::get('/json', 'Admin\BlogsController@json');
        Route::get('/create', 'Admin\BlogsController@create');
        Route::post('/store', 'Admin\BlogsController@store');
        Route::get('/edit/{id}', 'Admin\BlogsController@edit');
        Route::put('/update/{id}', 'Admin\BlogsController@update');
        Route::delete('/delete/{id}', 'Admin\BlogsController@destroy');
    });

});
