<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establishments/create', [EstablishmentController::class, 'create'])->name('establishment.create');
    Route::post('/establishments', [EstablishmentController::class, 'store'])->name('establishment.store');
    Route::get('/establishments/edit', [EstablishmentController::class, 'edit'])->name('establishment.edit');
    //images
    Route::post('/images/store', [ImageController::class, 'store'])->name('image.store');
    Route::post('/images/delete', [ImageController::class, 'destroy'])->name('image.destroy');
});
