<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('anak', AnakController::class);

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('pdf',   [LaporanController::class, 'pdf'])   ->name('pdf');
    Route::get('print', [LaporanController::class, 'print']) ->name('print');
    Route::get('excel', [LaporanController::class, 'excel']) ->name('excel');
    Route::get('csv',   [LaporanController::class, 'csv'])   ->name('csv');
});
