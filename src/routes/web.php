<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientDateController;
use App\Http\Controllers\PendingDateController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClientMiddleware;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return redirect(url('/'));
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::get('/admin', function () {
        return view('admin');
    })->middleware(AdminMiddleware::class)->name('admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users', UserController::class)->middleware(AdminMiddleware::class);

    Route::get('/dates', [DateController::class, 'edit'])->name('dates.edit');
    Route::patch('/dates', [DateController::class, 'update'])->name('dates.update');
    Route::delete('/dates', [DateController::class, 'destroy'])->name('dates.destroy');

    //Route::resource('/dates', DateController::class)->middleware(AdminMiddleware::class);
    Route::resource('/dates', DateController::class)->middleware(AdminMiddleware::class);
    Route::resource('/mydates', ClientDateController::class)->middleware(ClientMiddleware::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('/pending_dates', PendingDateController::class)->middleware(AdminMiddleware::class);

    Route::get('/cars', [CarsController::class, 'index'])->name('cars');
});

require __DIR__.'/auth.php';
