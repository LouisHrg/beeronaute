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
	Route::get('/publications/create', 'AdminController@newPublication')->name('publications-create');
	Route::post('savePublication','PublicationsController@savePublication');
	//Edition de publication
	Route::get('/publications/edit/{id}', 'AdminController@editPublication')->name('admin-publications-edit');
	Route::post('updatePublication/{id}','PublicationsController@updatePublication')->name('publication-update');


	Route::get('/users', 'AdminController@users')->name('admin-users-browse');

	Route::get('/users/edit/{id}', 'AdminController@editUser')->name('admin-users-edit');
	Route::post('updateUser/{id}','AdminController@updateUser')->name('admin-users-update');

	Route::get('/users/create', 'AdminController@newUser')->name('admin-users-create');
	Route::post('saveUser','UsersController@saveUser');


});

Route::group(['prefix' => 'manage','middleware' => ['role:manager','auth']], function () {
	
	Route::get('/', 'ManageController@home')->name('manage-home');

	Route::get('/publications', 'ManageController@home')->name('manage-publications');

	Route::get('/stats', 'ManageController@home')->name('manage-stats');

	Route::get('/bars', 'ManageController@bars')->name('manage-bars');
	
	Route::get('/bars/create', 'ManageController@newBar')->name('manage-bars-create');
	Route::get('/bars/edit/{id}','ManageController@editBar')->name('manage-publications-edit');

	Route::get('/events', 'ManageController@home')->name('manage-events');

	Route::get('/settings', 'ManageController@home')->name('manage-settings');

	// Route::post('saveBar','ManageController@saveBar');
	
	// Route::post('updateBar/{id}','ManageController@updateBar');
	

});


Route::group(['prefix' => '','middleware' => ['role:manager,admin','auth']], function () {
	

	Route::post('saveBar','BarsController@saveBar');
	
	Route::post('updateBar/{id}','BarsController@updateBar');

});

Route::get('/test', 'TestController@test')->name('test');