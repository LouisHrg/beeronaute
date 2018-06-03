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

Route::group(['prefix' => '/',  'middleware' => 'auth'], function()
{
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/news', 'HomeController@news')->name('news');
});

Route::group(['prefix' => 'admin','middleware' => ['role:admin','auth']], function () {
	Route::get('/', 'AdminController@home')->name('admin-home');
	Route::get('/publications', 'AdminController@publications')->name('admin-publications-browse');
	Route::get('/publications/create', 'AdminController@newPublication')->name('admin-publications-create');
	Route::post('publications','AdminController@savePublication');

});

/*Route::group(['prefix' => 'manage','middleware' => ['role:manager']], function () {
	
	Route::get('/', 'AdminController@home')->name('manage-home');

});*/


Route::get('/test', 'TestController@test')->name('test');