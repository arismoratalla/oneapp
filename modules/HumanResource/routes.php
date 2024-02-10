<?php

use Illuminate\Support\Facades\Route;

Route::prefix('hr')->group(function () {
    Route::get('/', [Modules\HumanResource\Http\Controllers\HumanResourceController::class, 'index'])->name('hr.index');
});