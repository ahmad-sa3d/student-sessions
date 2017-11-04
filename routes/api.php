<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get( '/', function(){
	return response()->json( [ 'message' => 'apis are prefixed by /v1/' ] );
} );


Route::group( [ 'prefix' => 'v1', 'as' => '.v1' ], function(){

	Route::get( '/', function(){
		return response()->json( [
			'message' => 'send post request to /v1/sessions'
		] );
	} );

	Route::post( '/sessions', 'StudentController@getSessions' )->name( 'sessions' );

} );
