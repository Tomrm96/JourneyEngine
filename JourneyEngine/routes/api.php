<?php

use App\Http\Controllers\MapsController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\TrainController;
use Illuminate\Support\Facades\Route;

Route::get('/getTraffic', [MapsController::class, 'getTraffic'])->name('getTraffic');
Route::get('/getArrDepBoardWithDet', [TrainController::class, 'getArrDepBoardWithDet'])->name('getArrDepBoardWithDet');
Route::get('/getNews', [ScraperController::class, 'getNews'])->name('getNews');