<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
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
Route::get('/', [PageController::class, 'index'])->name('page.listing');
Route::get('/de/{post:uuid?}', [PageController::class, 'index'])->name('de.page.listing');
Route::get('/fr/{post:uuid?}', [PageController::class, 'index'])->name('fr.page.listing');
Route::get('/it/{post:uuid?}', [PageController::class, 'index'])->name('it.page.listing');

// XHR routes
Route::get('/api/posts/get/{offset?}', [PostController::class, 'get']);
Route::get('/api/post/find/{uuid}', [PostController::class, 'find']);
Route::post('/api/post/save', [PostController::class, 'store']);
Route::post('/api/post/image', [PostController::class, 'upload']);
Route::post('/api/order/save', [OrderController::class, 'store']);

Route::get('/img/download', [PostController::class, 'download']);


