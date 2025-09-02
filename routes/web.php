<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// authentication
Route::get('/register', [RegisterController::class, 'formRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'formLogin']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'viewDashboard']);
    Route::get('/contact', [DashboardController::class, 'viewContact']);
    Route::get('/about', [DashboardController::class, 'viewAbout']);

    // pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'viewPengajuan']);
    Route::post('/pengajuan', [PengajuanController::class, 'store']);;
    Route::put('/pengajuan/update/{id}', [PengajuanController::class, 'updatePengajuan']);
    Route::delete('/pengajuan/delete/{id}', [PengajuanController::class, 'deletePengajuan']);

    // pengesahan
    Route::get('/notifikasi', [NotifikasiController::class, 'getNotification']);
});

