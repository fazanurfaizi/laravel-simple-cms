<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Api\NewsController@index');
        Route::get('/latest', 'Api\NewsController@latest');
    });

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'Api\BlogsController@index');
        Route::get('/latest', 'Api\BlogsController@latest');
    });

    Route::group(['prefix' => 'features'], function () {
        Route::get('/', 'Api\FeaturesController@index');
        Route::get('/latest', 'Api\FeaturesController@latest');
    });

});
