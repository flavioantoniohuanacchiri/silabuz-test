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

Route::group([
	'prefix'	=>	'album'
], function() {
	Route::get("/{id}", 'App\Http\Controllers\AlbumController@show')->name("album.show");
	Route::get("/{id}/top", 'App\Http\Controllers\AlbumController@trackList')->name("album.trackList");
	Route::post("", 'App\Http\Controllers\AlbumController@store')->name("album.store");
});

Route::group([
	'prefix'	=>	'track'
], function() {
	Route::get("/{id}", 'App\Http\Controllers\TrackController@show')->name("track.show");
});

Route::group([
	'prefix'	=>	'search'
], function() {
	Route::get("", 'App\Http\Controllers\SearchController@index')->name("search.index");
});


