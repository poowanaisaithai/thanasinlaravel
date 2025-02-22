<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ImageUploadController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->middleware(['auth', 'verified', 'user'])->name('users.dashboard');


Route::post('/upload-image', [ImageUploadController::class, 'store']);


Route::get('/supervisor/dashboard', function () {
    return view('supervisor.dashboard');
})->middleware(['auth', 'verified', 'supervisor'])->name('supervisor.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('logout', function () {
    auth()->logout();
    return to_route('login');
});

Route::get('/installments/create', [InstallmentController::class, 'create'])
    ->middleware(['auth', 'admin'])  // Ensure user is authenticated and an admin
    ->name('installments.create');

Route::post('/installments', [InstallmentController::class, 'store'])
    ->middleware(['auth', 'admin'])  // Ensure only authenticated and admin users can access
    ->name('installments.store');

Route::get('/print-receipt', [InstallmentController::class, 'printReceipt'])->name('print.receipt');


Route::get('/layouts/registeradmin', [RegisterController::class, 'showRegistrationForm'])
    ->middleware(['auth', 'admin'])  // Ensure user is authenticated and an admin
    ->name('layouts.registeradmin');

Route::post('/registeradmin', [RegisterController::class, 'store'])
    ->middleware(['auth', 'admin'])  // Ensure user is authenticated and an admin
    ->name('registeradmin.store');

// Route for editing user details
Route::get('/users/{user}/edit', [RegisterController::class, 'edit'])->name('users.edit')->middleware('auth', 'admin');

// Route to update user details
Route::put('/users/{user}', [RegisterController::class, 'update'])->name('users.update')->middleware('auth', 'admin');

// Route for deleting a user
Route::delete('/users/{user}', [RegisterController::class, 'destroy'])->name('users.destroy')->middleware('auth', 'admin');

Route::get('/users', [RegisterController::class, 'showUsers'])
    ->middleware(['auth', 'admin'])
    ->name('users.list');


Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::middleware('auth')->group(function () {
    // Route for /dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users/dashboard', [DashboardController::class, 'index'])->name('users.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/installments/pdf/{id}', [PDFController::class, 'generatePDF'])
        ->name('installments.pdf')
        ->middleware('verified'); // กรณีต้องการให้ยืนยันอีเมลก่อนใช้
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    return "Routes cache cleared!";
});

require __DIR__ . '/auth.php';
