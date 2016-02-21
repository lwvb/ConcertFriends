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
	//Social Login
	Route::get('/login/{provider?}',[
	    'uses' => 'Auth\AuthController@getSocialAuth',
	    'as'   => 'auth.getSocialAuth'
	]);
	Route::get('/login/callback/{provider?}',[
	    'uses' => 'Auth\AuthController@getSocialAuthCallback',
	    'as'   => 'auth.getSocialAuthCallback'
	]);
	Route::get('/logout',[
	    'uses' => 'Auth\AuthController@logout',
	    'as'   => 'auth.logout'
	]);

	Route::get('/', 'ConcertController@map');
	Route::get('/list', 'ConcertController@listall');
	Route::get('/concert/new', ['middleware' => 'auth', 'uses' => 'ConcertController@edit']);
	Route::post('concert/store', ['middleware' => 'auth', 'before' => 'csrf', 'uses' => 'ConcertController@store']);
	Route::get('/concert/{concertId}', 'ConcertController@show')->where(['concertId' => '[\w]+']);
	Route::get('/concert/{concertId}/edit', ['middleware' => 'auth', 'uses' => 'ConcertController@edit'])->where(['concertId' => '[\w]+']);


	//Route::get('/user/{facebookUid}', 'UserController@show')->where(['facebookUid' => '[0-9]+']);
	Route::get('/api/subscribe/{concertId}', ['middleware' => 'auth', 'uses' => 'ApiController@subscribe'])->where(['concertId' => '[\w]+']);


	Route::get('/privacy', function(){ return view('pages/privacy'); });
	Route::get('/help', function(){ return view('pages/help'); });
	Route::get('/about', function(){ return view('pages/about'); });
	Route::get('/terms', function(){ return view('pages/terms'); });
	Route::get('/contact', function(){ return view('pages/contact'); });
});

Route::get('/api/markers', 'ApiController@markers');
