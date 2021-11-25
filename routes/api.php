<?php

use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KirimanController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\PendidikanController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\ProfilController;
use App\Models\Pendidikan;
use App\Models\Produk;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/api-kiriman', KirimanController::class);
    Route::apiResource('/produk', ProdukController::class);
    Route::apiResource('/layanan', LayananController::class);
    Route::apiResource('/profil', ProfilController::class);
    Route::apiResource('/pendidikan', PendidikanController::class);
    Route::apiResource('/agenda', AgendaController::class);
});

Route::apiResource('/produk-public', ProdukController::class);
Route::apiResource('/kiriman-public', KirimanController::class);
Route::apiResource('/layanan-public', LayananController::class);
Route::apiResource('/agenda-public', AgendaController::class);
