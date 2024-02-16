<?php

use Illuminate\Support\Facades\Route;

Route::prefix('hr')->group(function () {
    Route::get('/', [Modules\HumanResource\Http\Controllers\HumanResourceController::class, 'index'])->name('hr.index');

    Route::prefix('leave')->group(function () {
        Route::get('/', [Modules\HumanResource\Http\Controllers\LeaveController::class, 'index'])->name('leave.index');
        Route::post('/store', [Modules\HumanResource\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');

        
    });

    Route::prefix('leavetypes')->group(function () {
        Route::get('/', [Modules\HumanResource\Http\Controllers\LeaveTypeController::class, 'index'])->name('leavetype.index');
    });
});