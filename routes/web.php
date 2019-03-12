<?php

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {

        Route::get('/', function () {
            return view('auth.login');
        });

        Route::resource('clients', 'ClientController');
        Route::resource('users', 'UserController');
        Route::resource('orders', 'OrdersController');
        Route::resource('articles', 'ArticlesController');
        Route::resource('notifications', 'NotificationsController');
        Route::resource('governrates', 'GovernratesController');
        Route::resource('cities', 'CitiesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('cantacts', 'CantactsController');
        Route::resource('setting', 'SettingController');

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

    });


