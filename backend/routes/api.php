<?php

use App\Http\Controllers\Api\V1\LeagueController;
use App\Http\Controllers\Api\V1\NFLGameController;
use App\Http\Controllers\Api\V1\PlayerGameController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// NOTE Public Routes
Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function(){
    Route::apiResource('nflgames', NFLGameController::class)->only([
        'index'
    ]);
});


Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1', 'middleware'=>'auth:sanctum'], function(){
    Route::apiResource('nflgames', NFLGameController::class)->only([
        'show', 'store', 'update'
    ]);

    Route::apiResource('player_games', PlayerGameController::class)->only([
        'index', 'show', 'store', 'update'
    ]);

    Route::apiResource('my-leagues', LeagueController::class)->only([
        'index', 'show', 'store', 'update'
    ]);

    Route::apiResource('my-teams', TeamController::class)->only([
        'index', 'show', 'store', 'update'
    ]);

    Route::get('/profile/{id}', [ProfileController::class, 'show']);

    
});
// 