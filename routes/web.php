<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\DashboardHome;
use App\Http\Controllers\Dashboard\DashboardLetter;
use App\Http\Controllers\Dashboard\DashboardZoom;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('login');

// DASHBOARD PAGE
Route::group(['prefix'=> 'dashboard'], function(){
    Route::get('/', [DashboardHome::class, 'index']);
    Route::get('/tte-elektronik', [DashboardLetter::class, 'index']);
    Route::get('/booking-zoom', [DashboardZoom::class, 'index']);
    Route::get('/laporan-tte', [DashboardLetter::class, 'report']);
    Route::get('/laporan-zoom', [DashboardZoom::class, 'report']);
    
    Route::post('/tte-elektronik', [DashboardLetter::class, 'postHandler']);
    Route::post('/booking-zoom', [DashboardZoom::class, 'postHandler']);
    Route::post('/laporan-tte', [DashboardLetter::class, 'postHandler']);
    Route::post('/laporan-zoom', [DashboardZoom::class, 'postHandler']);
});

// API
Route::get('/api/letter/{letter:id}', [APIController::class, 'letter']);
Route::get('/api/zoom/{zoom:id}', [APIController::class, 'zoom']);