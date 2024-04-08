<?php

use App\Http\Controllers\HolidayController;
use Illuminate\Support\Facades\Route;

Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays.index');
Route::get('/holidays/{id}', [HolidayController::class, 'show'])->name('holidays.show');
Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
Route::put('/holidays/{id}', [HolidayController::class, 'update'])->name('holidays.update');
Route::delete('/holidays/{id}', [HolidayController::class, 'destroy'])->name('holidays.destroy');
