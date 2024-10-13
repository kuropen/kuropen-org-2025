<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/.well-known/nostr.json', [\App\Http\Controllers\NostrController::class, 'nip05']);

Route::prefix('/pgn-archives')
    ->controller(\App\Http\Controllers\RedirectedArchiveController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{slug}', 'withSlug');
    });

Route::prefix('/staff-zone')
    ->controller(\App\Http\Controllers\StaffZoneController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/auth-callback', 'authCallback');
        Route::get('/logout', 'logout')->name('staff.logout');
        Route::middleware(\App\Http\Middleware\StaffZoneEntryCheckMiddleware::class)
            ->group(function () {
                Route::get('/menu', 'menu');
            });
    });

