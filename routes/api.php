<?php

// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/health', [\App\Http\Controllers\HealthCheckApiController::class, 'healthCheck']);

Route::middleware(\App\Http\Middleware\EncryptCookies::class)
    ->put('cookie-policy/confirm', [\App\Http\Controllers\CookiePolicyController::class, 'confirm']);

Route::get('/documents', [\App\Http\Controllers\DocumentListApiController::class, '__invoke']);
