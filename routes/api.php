<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PoliController;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\SpesialisController;
use App\Http\Controllers\Api\PoliklinikController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Spesialis
Route::get('/spesialis', [SpesialisController::class, 'index'])->name('spesialis.index');
Route::post('/spesialis', [SpesialisController::class, 'store'])->name('spesialis.store');
Route::get('/spesialis/{id}', [SpesialisController::class, 'show'])->name('spesialis.show');
Route::put('/spesialis/{id}', [SpesialisController::class, 'update'])->name('spesialis.update');
Route::delete('/spesialis/{id}', [SpesialisController::class, 'destroy'])->name('spesialis.destroy');


// Poli
Route::get('/poliklinik', [PoliklinikController::class, 'index'])->name('poli.index');
Route::post('/poliklinik', [PoliklinikController::class, 'store'])->name('poli.store');
Route::get('/poliklinik/{id}', [PoliklinikController::class, 'show'])->name('poli.show');
Route::put('/poliklinik/{id}', [PoliklinikController::class, 'update'])->name('poli.update');
Route::delete('/poliklinik/{id}', [PoliklinikController::class, 'destroy'])->name('poli.destroy');

// Dokter
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
Route::get('/dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');
Route::put('/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
