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

Route::group(['prefix' => '/',  'middleware' => ['auth','push']], function()
{
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/profil/{username}', 'HomeController@profile')->name('profile');
	Route::get('/profil', 'HomeController@myself')->name('profile-me');
	
	Route::get('/news/{slug}', 'HomeController@singlePublication')->name('publication-single');

	Route::get('/bar/{slug}', 'HomeController@singleBar')->name('bar-single');
	Route::get('/bars/{slug}/events', 'HomeController@allEvents')->name('bar-events');
	Route::get('/bar/{slug}/gallery', 'HomeController@barGallery')->name('bar-gallery');
	
	Route::get('/bars', 'HomeController@bars')->name('bars');
	
	Route::get('/events', 'HomeController@events')->name('events');
	Route::get('/event/{id}', 'HomeController@singleEvent')->name('event-single');

	Route::get('/notifs', 'HomeController@allNotifs')->name('notifs');
	
	Route::get('/news', 'HomeController@news')->name('news');
	Route::get('/search', 'HomeController@search')->name('search');
	Route::get('/events', 'HomeController@events')->name('events');

	Route::get('/events/me', 'HomeController@eventsMe')->name('events-me');
	Route::get('/recommandations', 'HomeController@recommandations')->name('recommandations');

	Route::post('/subscribe-to-event/{id}', 'SubscriptionsController@attachEvent')->name('subscribe-to-event');
	Route::post('/unsubscribe-to-event/{id}', 'SubscriptionsController@dettachEvent')->name('unsubscribe-to-event');

	Route::post('/subscribe-to-bar/{id}', 'SubscriptionsController@attachBar')->name('subscribe-to-bar');
	Route::post('/unsubscribe-to-bar/{id}', 'SubscriptionsController@dettachBar')->name('unsubscribe-to-bar');
});

Route::group(['prefix' => 'admin','middleware' => ['role:admin','auth']], function () {

	Route::get('/', 'AdminController@home')->name('admin-home');
	
	Route::get('/publications', 'AdminController@publications')->name('admin-publications-browse');
	
	Route::get('/publications/create', 'AdminController@newPublication')->name('publications-create');
	Route::get('/publications/edit/{id}', 'AdminController@editPublication')->name('admin-publications-edit');

	Route::get('/users', 'AdminController@users')->name('admin-users-browse');
	Route::get('/users/edit/{id}', 'AdminController@editUser')->name('admin-users-edit');
	Route::post('updateUser/{id}','UsersController@updateUser')->name('admin-users-update');


	Route::get('/events', 'AdminController@events')->name('admin-events');
	Route::get('/events/create', 'AdminController@newEvent')->name('admin-event-create');
	Route::get('/events/edit/{id}', 'AdminController@editEvent')->name('admin-event-edit');

	Route::get('/bars', 'AdminController@bars')->name('admin-bars');
	Route::get('/bars/create', 'AdminController@newBar')->name('admin-bars-create');
	Route::get('/bars/edit/{id}','AdminController@editBar')->name('admin-bars-edit');
	Route::get('/bars/edit/gallery/{id}','AdminController@editBarGallery')->name('admin-bars-edit-gallery');

	Route::get('/users/create', 'AdminController@newUser')->name('admin-users-create');
	Route::post('saveUser','UsersController@saveUser');
	
VisitStats::routes();


});

Route::group(['prefix' => 'manage','middleware' => ['role:manager','auth']], function () {
	
	Route::get('/', 'ManageController@home')->name('manage-home');

	Route::get('/stats', 'ManageController@home')->name('manage-stats');

	Route::get('/bars', 'ManageController@bars')->name('manage-bars');
	Route::get('/bars/create', 'ManageController@newBar')->name('manage-bars-create');
	Route::get('/bars/edit/{id}','ManageController@editBar')->name('manage-bars-edit');
	Route::get('/bars/edit/gallery/{id}','ManageController@editBarGallery')->name('manage-bars-edit-gallery');



	Route::get('/posts', 'ManageController@posts')->name('manage-posts');
	Route::get('/posts/create', 'ManageController@newPost')->name('manage-post-create');
	Route::get('/posts/edit/{id}', 'ManageController@editPost')->name('manage-post-edit');


	Route::get('/events', 'ManageController@events')->name('manage-events');
	Route::get('/events/create', 'ManageController@newEvent')->name('manage-event-create');
	Route::get('/events/edit/{id}', 'ManageController@editEvent')->name('manage-event-edit');

	Route::get('/settings', 'ManageController@home')->name('manage-settings');
	

});


Route::group(['prefix' => '','middleware' => ['role:manager|admin','auth']], function () {
	

	Route::post('saveBar','BarsController@saveBar')->middleware('redir:manage-bars,admin-bars');
	
	Route::post('updateBar/{id}','BarsController@updateBar')->middleware('redir:manage-bars,admin-bars');
	
	Route::post('/saveFeatured/{id}','BarsController@saveFeatured');

	Route::post('/addToGallery/{id}','BarsController@addToGallery');

	Route::post('/bar-delete/{id}','BarsController@deleteBar')->name('bar-delete')->middleware('redir:manage-bars,manage-bars');

	Route::get('/deleteFromGallery/{bar}/{img}','BarsController@deleteFromGallery')->name('deleteFromGallery');

	Route::post('savePublication','PublicationsController@savePublication');

	Route::post('updatePublication/{id}','PublicationsController@updatePublication')->name('publication-update');

	Route::post('savePost/{id}','PostsController@savePost')->name('post-save');
	Route::post('savePostEvent/{id}','PostsController@savePostEvent')->name('post-save-event');

	Route::post('updatePost/{id}','PostsController@updatePost')->name('post-update');	

	Route::post('saveEventSingle','EventsController@saveEventSingle')->name('event-save-single')->middleware('redir:manage-events,admin-events');
	Route::post('saveEvent','EventsController@saveEvent')->name('event-save')->middleware('redir:manage-events,admin-events');
	Route::post('editEvent/{id}','EventsController@editEvent')->name('event-edit')->middleware('redir:manage-events,admin-events');

	Route::post('updateEvent/{id}','EventsController@updateEvent')->name('event-update');

});

Route::get('/test', 'TestController@test')->name('test');