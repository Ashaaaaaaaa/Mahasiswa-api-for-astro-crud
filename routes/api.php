<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'check']);
Route::get('logout', [UserController::class, 'logout']);

Route::get('mahasiswa', [MahasiswaController::class, 'index']);
Route::post('mahasiswa/store', [MahasiswaController::class, 'store']);
Route::get('mahasiswa/show/{id}', [MahasiswaController::class, 'show']);
// Route::get('mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']);
Route::put('mahasiswa/{id}/edit', [MahasiswaController::class, 'update']);
Route::delete('mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy']);
