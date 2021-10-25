<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KirimanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [DashboardController::class, 'index']);

Auth::routes(['verify' => true]);

// Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('kiriman', KirimanController::class);
    Route::resource('user', UserController::class);
    Route::resource('profil-user', ProfilController::class);
    Route::resource('pendidikan-user', PendidikanController::class);
    Route::resource('layananWeb', LayananController::class);
    Route::resource('agendaWeb', AgendaController::class);
    Route::resource('produkWeb', ProdukController::class);
    Route::post('upfoto/{id}', [ProfilController::class, 'uploadFoto'])->name('upfoto');
});

Route::get('/changeStatus', [UserController::class, 'changeStatus'])->name('change-status');
Route::get('/changeAgendaStatus', [AgendaController::class, 'switchAgendaStatus'])->name('change-agenda-status');
