<?php

// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

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

Route::get('/', [\App\Http\Controllers\DocumentRootController::class, 'index']);

Route::get('/about', [\App\Http\Controllers\MarkdownFileController::class, 'about'])
    ->name('about');

Route::get('/privacy', [\App\Http\Controllers\DocumentRootController::class, 'privacy']);

Route::get('/legal', [\App\Http\Controllers\MarkdownFileController::class, 'legal'])
    ->name('legal');

Route::get('/social_policy', [\App\Http\Controllers\MarkdownFileController::class, 'social_policy'])
    ->name('social_policy');

Route::get('/pengreen', [\App\Http\Controllers\MarkdownFileController::class, 'pengreen'])
    ->name('pengreen');

Route::get('/planet', [\App\Http\Controllers\PlanetController::class, 'index'])
    ->name('planet');

Route::get('/.well-known/nostr.json', [\App\Http\Controllers\NostrController::class, 'nip05']);

Route::prefix('/contact')
    ->middleware(\App\Http\Middleware\TorDetectionMiddleware::class)
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\MarkdownFileController::class, 'contact'])
            ->name('contact');
        Route::get('/form', [\App\Http\Controllers\ContactFormController::class, 'show']);
        Route::post('/form/send', [\App\Http\Controllers\ContactFormController::class, 'submit'])
            ->name('contact.send');
    });

Route::prefix('/micropen')
    ->middleware(\App\Http\Middleware\MisskeyAreaCheckMiddleware::class)
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\MisskeyInformationController::class, 'index'])->name('micropen.index');
        Route::get('/terms', [\App\Http\Controllers\MarkdownFileController::class, 'micropen_terms'])->name('micropen.terms');
        Route::get('/blocked', [\App\Http\Controllers\MisskeyInformationController::class, 'blockedServers'])->name('micropen.blocked');
        Route::get('/how_to_follow', [\App\Http\Controllers\MisskeyInformationController::class, 'howToFollow'])->name('micropen.how_to_follow');
    });

Route::prefix('/photos')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\PhotoController::class, 'index']);
    });

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
                Route::get('/menu', 'menu')->name('staff.menu');
                Route::get('/inquiry/list', 'listInquiry')->name('staff.inquiry.list');
                Route::get('/inquiry/show/{slug}', 'showInquiry')->name('staff.inquiry.show');
                Route::get('/inquiry/delete/{slug}', 'deleteInquiry')
                    ->name('staff.inquiry.delete')
                    ->middleware('signed');
            });
    });

