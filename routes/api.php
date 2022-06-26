<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\AuthController@logout']);
//Route::get('/me', 'App\Http\Controllers\AuthController@me');

Route::group([
	'prefix'	=>	'artist'
], function() {
	Route::get("/{id}", 'App\Http\Controllers\ArtistController@show')->name("artist.show");
	Route::get("/{id}/top", 'App\Http\Controllers\ArtistController@trackList')->name("artist.trackList");
	Route::post("", 'App\Http\Controllers\ArtistController@store')->name("artist.store");
});