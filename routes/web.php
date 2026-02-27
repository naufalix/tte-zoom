<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\DashboardHome;
use App\Http\Controllers\Dashboard\DashboardLetter;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('login');

// DASHBOARD PAGE
Route::group(['prefix'=> 'dashboard'], function(){
    Route::get('/', [DashboardHome::class, 'index']);
    Route::get('/tte-elektronik', [DashboardLetter::class, 'index']);
    Route::get('/booking-zoom', [DashboardLetter::class, 'index2']);
    Route::get('/laporan', [DashboardLetter::class, 'report']);
    
    Route::post('/tte-elektronik', [DashboardLetter::class, 'postHandler']);
    Route::post('/booking-zoom', [DashboardLetter::class, 'postHandler']);
    Route::post('/laporan', [DashboardLetter::class, 'postHandler']);
});