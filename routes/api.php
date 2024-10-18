<?php

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

Route::prefix('inquiry')->controller(\App\Http\Controllers\InquiryApiController::class)->group(function () {
    Route::get('token', 'getToken');
    Route::get('types', 'getTypes');
    Route::post('send', 'send');
});
