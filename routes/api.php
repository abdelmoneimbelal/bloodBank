<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace' => 'Api'],function(){

    Route::get('governrates','MainController@governrates');
    Route::get('cities','MainController@cities');
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('reset','AuthController@reset');
    Route::post('password','AuthController@password');
    Route::get('categories','MainController@categories');
    Route::get('articles','MainController@articles');
    Route::get('setting','MainController@setting');
    Route::get('notification','MainController@notification');

    Route::group(['middleware' => 'auth:api'], function () {
        //Route::get('articles','MainController@articles');
        Route::post('profile','AuthController@profile');
        Route::post('registerToken','AuthController@registerToken');
        Route::post('removeToken','AuthController@removeToken');
        Route::post('creatorder','MainController@creatorder');
        Route::get('showorder','MainController@showorder');
        Route::post('favouriteposts','MainController@favouriteposts');
        Route::get('myfavourites','MainController@myfavourites');
    });


});
