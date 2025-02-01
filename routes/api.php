<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use L5Swagger\Http\Controllers\SwaggerController;

Route::post('/register', [UserController::class, 'register']);

Route::get('/user/{id}', [UserController::class, 'show']);

Route::post('/transaction', [TransactionController::class, 'store']);

Route::get('/transactions', [TransactionController::class, 'index']);

