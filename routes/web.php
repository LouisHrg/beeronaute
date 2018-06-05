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
	Route::get('/news/{slug}', ['uses' =>'HomeController@singlePublication', 'as'=>'publication-single']);
});

Route::group(['prefix' => 'admin','middleware' => ['role:admin','auth']], function () {
	Route::get('/', 'AdminController@home')->name('admin-home');
	
	//Affichage de publication
	Route::get('/publications', 'AdminController@publications')->name('admin-publications-browse');
	
	//Ajout de publication
	Route::get('/publications/create', 'AdminController@newPublication')->name('admin-publications-create');
	Route::post('savePublication','AdminController@savePublication');
	//Edition de publication
	Route::get('/publications/edit/{id}', 'AdminController@editPublication')->name('admin-publications-edit');
	Route::post('updatePublication/{id}','AdminController@updatePublication')->name('admin-publication-update');

});

/*Route::group(['prefix' => 'manage','middleware' => ['role:manager']], function () {
	
	Route::get('/', 'AdminController@home')->name('manage-home');

});*/


Route::get('/test', 'TestController@test')->name('test');