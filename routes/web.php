<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [Controller::class, 'index']);
// Route::get('/austinoftheday', [\App\Http\Controllers\ImageController::class, 'showDaily']);
Route::get('/', [Controller::class, 'showDaily']);

Route::group(['auth:sanctum', 'verified'], function() {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('video/new', [\App\Http\Controllers\VideoController::class, 'create']);
    Route::post('video/new', [\App\Http\Controllers\VideoController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
