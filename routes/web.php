<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\VoterController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;


// Auth routes
Auth::routes(['verify' => false, 'register' => false]);
Route::get('/logout', 'Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Admin Web routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum', 'verified')->group(function() {
  Route::get('administration/{any?}', function () {
    return view('dashboards.administration.app');
  })->where('any', '.*')->middleware('role:admin')->name('dashboard_admin');
});

// Page routes
Route::get('/de/{post:uuid?}', [PostController::class, 'index'])->name('de.page.listing');
Route::get('/fr/{post:uuid?}', [PostController::class, 'index'])->name('fr.page.listing');
Route::get('/it/{post:uuid?}', [PostController::class, 'index'])->name('it.page.listing');
Route::get('/{post:uuid?}', [PostController::class, 'index'])->name('page.listing');

// XHR routes
Route::get('/api/posts/get/{hash}/{offset?}', [PostController::class, 'get']);
Route::get('/api/post/find/{hash}/{uuid}', [PostController::class, 'find']);
Route::post('/api/post/save', [PostController::class, 'store']);
Route::post('/api/post/image', [PostController::class, 'upload']);
Route::get('/api/voter/check/{hash}', [VoteController::class, 'check']);
Route::post('/api/vote', [VoteController::class, 'store']);
Route::put('/api/vote', [VoteController::class, 'remove']);

Route::get('/img/download', [PostController::class, 'download']);


