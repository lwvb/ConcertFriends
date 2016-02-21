<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

	Route::get('/', 'ConcertController@map');
	Route::get('/list', 'ConcertController@listall');
	Route::get('/concert/new', 'ConcertController@edit');
	Route::post('concert/store', ['before' => 'csrf', 'uses' => 'ConcertController@store']);
	Route::get('/concert/{concertId}', 'ConcertController@show')->where(['concertId' => '[\w]+']);
	Route::get('/concert/{concertId}/edit', 'ConcertController@edit')->where(['concertId' => '[\w]+']);

});
