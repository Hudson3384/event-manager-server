<?php

use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('auth', [AuthController::class, 'redirectToAuth']);
Route::get('auth/callback', [AuthController::class, 'handleAuthCallback']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
