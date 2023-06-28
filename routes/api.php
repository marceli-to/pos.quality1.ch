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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
  Route::get('user', 'Api\UserController@find');
  Route::get('votes', 'Api\VoteController@get');

  // Posts
  Route::get('posts/{type}', 'Api\PostController@get');
  Route::get('post/{post}', 'Api\PostController@find');
  Route::get('post/state/{post}', 'Api\PostController@toggle');
  Route::get('post/restore/{id}', 'Api\PostController@restore');
  Route::delete('post/{post}', 'Api\PostController@destroy');
});



