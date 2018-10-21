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

Route::get('/home', 'HomeController@index')->name('home');
//published events for users
Route::get('/events/published', 'User\EventController@publishedEvents');
Route::post('/events/published/search', 'User\EventController@publishedEventsSearch');
//proposed event for users
Route::get('/events/proposed', 'User\EventController@proposedEvents');
Route::post('/events/proposed/store', 'User\EventController@proposedEventsStore');
Route::get('/events/proposed/{id?}', 'User\EventController@proposedEventsEdit');
Route::post('/events/proposed/{id?}', 'User\EventController@proposedEventsUpdate');
Route::delete('/events/proposed/delete/{id?}', 'User\EventController@proposedEventsDelete');
