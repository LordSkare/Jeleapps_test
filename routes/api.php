<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// API маршруты
Route::post('registration', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('profile', [AuthController::class, 'profile']);