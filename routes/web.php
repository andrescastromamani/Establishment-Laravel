<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablishmentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establishments/create', [EstablishmentController::class, 'create'])->name('establishment.create');
    Route::get('/establishments/edit', [EstablishmentController::class, 'edit'])->name('establishment.edit');
});
