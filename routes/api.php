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
Route::group([

    'middleware' => 'api'

], function ($router) {

    
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('register', 'AuthController@register');
    Route::post('refresh', 'AuthController@refresh');
    
});

Route::get('movies', 'MovieController@index');
Route::get('movies/{id}', 'MovieController@show');
Route::post('movies', 'MovieController@store');
Route::put('movies/{id}', 'MovieController@update');
Route::delete('movies/{id}', 'MovieController@delete');

Route::get('role-users', 'UserController@getAllUsers');
Route::get('role-admins', 'UserController@getAllAdmins');
Route::get('grant-admin/{id}', 'UserController@grantRoleAdmin');
Route::get('revoke-admin/{id}', 'UserController@revokeRoleAdmin');

Route::get('current-user/{id}', 'UserController@currentUser');
Route::get('users', 'UserController@index');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');

Route::get('favorites/add/{userId}/{movieId}', 'MovieController@addToFavorites');
Route::get('favorites/remove/{userId}/{movieId}', 'MovieController@removeFromFavorites');
Route::get('favorites/{userId}', 'MovieController@getAll');



