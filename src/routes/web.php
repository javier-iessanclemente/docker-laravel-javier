<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::get('/admin', function () {
        return view('admin');
    })->middleware(AdminMiddleware::class)->name('admin');

    Route::get('/profile-edit', function () {
        return view('profile.edit');
    })->middleware(AdminMiddleware::class)->name('profile.edit');

    Route::get('/profile-update', function () {
        return view('profile.update');
    })->middleware(AdminMiddleware::class)->name('profile.update');
});

require __DIR__.'/auth.php';
