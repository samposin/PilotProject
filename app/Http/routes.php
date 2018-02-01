<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	/*
		Default route
	*/

	Route::get('/', function () {

	    return redirect('/admin/dashboard');

	});


	/*
		Authentication routes
	*/

	Route::auth();


	/*
		Admin routes
	*/

	Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {


		//Dashboard routes
	    Route::get('/',array('uses' => 'DashboardController@index', 'as' => 'dashboard-home'));
	    Route::get('dashboard',array('uses' => 'DashboardController@index', 'as' => 'dashboard-home'));
	    Route::get('my-account','MyAccountController@index');
	    Route::post('my-account','MyAccountController@update');
	    Route::get('my-account/change-password','MyAccountController@changePasswordShow');
	    Route::post('my-account/change-password','MyAccountController@changePasswordUpdate');



		//Users routes
	    Route::get('users',array('uses' => 'UsersController@index', 'as' => 'users-home'));
	    Route::post('users','UsersController@store');

	    Route::post('users/ajax-datatable',array('uses' => 'UsersController@getUsersForDatatableAjax', 'as' => 'users-datatable-ajax'));
	    Route::post('users/check-username-availability','UsersController@postCheckUsernameAvailability');
	    Route::post('users/check-email-availability','UsersController@postCheckEmailAvailability');
	    Route::get('users/{id}','UsersController@show');
	    Route::post('users/{id}','UsersController@update');
	    Route::delete('users',array('uses' => 'UsersController@delete', 'as' => 'user-delete'));



		//Persons routes
		Route::get('persons',array('uses' => 'PersonsController@index', 'as' => 'persons-home'));
		Route::post('persons','PersonsController@store');
		Route::get('persons/{id}','PersonsController@show');
		Route::post('persons/{id}','PersonsController@update');

		Route::delete('persons',array('uses' => 'PersonsController@delete', 'as' => 'person-delete'));

	});