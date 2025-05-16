<?php
use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'throttle:6,1'])->group(function () {
    Route::apiResource('cars', CocheController::class);
});
