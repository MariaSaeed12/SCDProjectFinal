<?php
use app\Http\Controllers\DoctorsAPIController;
use Illuminate\Support\Facades\Route;


Route::name('Doctor.')->prefix('Doctor')->group(function() {
    Route::get('/', [DoctorsAPIController::class, 'index'])->name('index');
    Route::get('create', [DoctorsAPIController::class, 'create'])->name('create');
    Route::post('store', [DoctorsAPIController::class, 'store'])->name('store');
    Route::get('edit/{id}', [DoctorsAPIController::class, 'edit'])->name('edit');
    Route::post('update', [DoctorsAPIController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [DoctorsAPIController::class, 'destroy'])->name('destroy');
});
