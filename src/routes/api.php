<?php
use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;

Route::apiResource('coches', CocheController::class);
Route::post('/coches/index', [CocheController::class, 'index']);
Route::post('/coches', [CocheController::class, 'store']);