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


// Route for dashboard 
Route::get('/',['as'=>'home','uses'=> 'FlightController@loadhome']);

// Route Login - logout 
Route::get('/login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::get('/logout', ['as' => 'getLogout', 'uses' => 'LoginController@getLogout']);

// Route get - post register 
Route::get('/register',['as'=>'regis','uses'=> function () {return view('register');}]);
Route::post('/postregister','RegisterController@store');

# Route for search list of flight 
Route::get('/flight-list',[
	'as'=> 'flight-list', 
	'uses'=> 'FlightController@getFlightlist'
]);

Route::get('/flight-detail/{fl_id}','FlightController@getDetail');
Route::get('/flight-book/{fl_id}',['as'=> 'flight-book','uses'=> 'FlightController@getBooking']);
Route::get('/flight-booking',['as'=> 'booking','uses'=> 'FlightController@insertBooking']);