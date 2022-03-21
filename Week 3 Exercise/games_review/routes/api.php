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

// API Resource routes
Route::apiResource("games", App\Http\Controllers\GamesController::class)->middleware("ensuretokenisvalid");

Route::post("register", "App\Http\Controllers\UsersController@register");
Route::post("login", "App\Http\Controllers\UsersController@login");
// Select all games, you have to use the fully qualified class name for the GamesController
// Route::get('games', 'App\Http\Controllers\GamesController@index');

// // Select all comments
// Route::get('comments', 'App\Http\Controllers\CommentsController@index');
// // Create new comment
// Route::get('comments', 'App\Http\Controllers\CommentsController@store');
// // Edit comment
// Route::get('comments', 'App\Http\Controllers\CommentsController@update');
// // Delete comment
// Route::get('comments', 'App\Http\Controllers\CommentsController@destroy');


// // Create new user
// Route::get('users', 'App\Http\Controllers\UsersController@store');
// // Delete user
// Route::get('users', 'App\Http\Controllers\UsersController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


