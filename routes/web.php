<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\DoctorsController;
use App\Http\Controllers\AdminController;
use App\Models\Doctor;


// [DOCTOR SEARCH - START]
Route::get('/search-doctors', function (Illuminate\Http\Request $request) {
    $query = $request->query('query', '');

    $doctors = Doctor::where('name', 'like', '%' . $query . '%')
        ->orWhere('specialty', 'like', '%' . $query . '%')
        ->get();

    return response()->json(
        $doctors,
    );
});
// [DOCTOR SEARCH - END]



Route::name('Doctor.')->prefix('Doctor')->group(function() {
    Route::get('/', [DoctorsController::class, 'index'])->name('index');
    Route::get('create', [DoctorsController::class, 'create'])->name('create');
    Route::post('store', [DoctorsController::class, 'store'])->name('store');
    Route::get('edit/{id}', [DoctorsController::class, 'edit'])->name('edit');
    Route::post('update', [DoctorsController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [DoctorsController::class, 'destroy'])->name('destroy');
});


// Home page route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact page route
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// About page route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Doctors page route
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors');

Route::prefix('admin')->group(function () {
    // List doctors
    Route::get('/doctors', [AdminController::class, 'index'])->name('admin.doctors.index');

    // Add a doctor
    Route::post('/doctors', [AdminController::class, 'store'])->name('admin.doctors.store');

    // Delete a doctor
    Route::delete('/doctors/{id}', [AdminController::class, 'destroy'])->name('admin.doctors.destroy');

    // Edit a doctor page route
    Route::get('/doctors/{doctor}/edit', [AdminController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('/doctors/{doctor}', [AdminController::class, 'update'])->name('admin.doctors.update');
});
