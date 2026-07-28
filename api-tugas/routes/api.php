<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\TahunAkademikController;
use App\Http\Controllers\Api\BimbinganController;
use App\Http\Controllers\Api\DataLengkapMahasiswaController;
use App\Http\Controllers\Api\ReferensiKejuaraanController;
use App\Http\Controllers\Api\PendaftaranPrestasiController;
use App\Http\Controllers\Api\CapaianPrestasiController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;

Route::name('api.')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('mahasiswa', MahasiswaController::class);
    Route::apiResource('dosen', DosenController::class);
    Route::apiResource('mata-kuliah', MataKuliahController::class);
    Route::apiResource('tahun-akademik', TahunAkademikController::class);
    Route::apiResource('bimbingan', BimbinganController::class);
    Route::apiResource('data-lengkap-mahasiswa', DataLengkapMahasiswaController::class);
    Route::apiResource('referensi-kejuaraan', ReferensiKejuaraanController::class);
    Route::apiResource('pendaftaran-prestasi', PendaftaranPrestasiController::class);
    Route::apiResource('capaian-prestasi', CapaianPrestasiController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('users', UserController::class);
});
