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


Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'IndexController@index')->name('index')->middleware('guest');

Route::group(['prefix' => '/home',  'middleware' => 'auth'], function()
{
	Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

});