<?php

use App\Http\Controllers\MapsController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\TrainController;
use Illuminate\Support\Facades\Route;


Route::controller(MapsController::class)->group(function (){
    Route::get('/getTraffic','getTraffic')->name('getTraffic');
});


Route::controller(TrainController::class)->group(function(){
    Route::get('/getArrDepBoardWithDet', 'getArrDepBoardWithDet')->name('getArrDepBoardWithDet');
});


Route::get('/getNews', [ScraperController::class, 'getNews'])->name('getNews');