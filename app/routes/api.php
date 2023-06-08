<?php

use App\Http\Controllers\GameApiController;
use App\Http\Controllers\GameinfoApiController;
use App\Http\Controllers\GameLogicController;
use App\Http\Controllers\GameUserApiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageApiController;
use App\Http\Controllers\TableApiController;
use App\Http\Controllers\TeamApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\WeaponApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('games', GameApiController::class)->only(['index', 'show']);
    Route::get('currentgames', [GameApiController::class, 'current']);
    Route::apiResource('userinfo', GameUserApiController::class)->only(['show', 'store']);
    Route::get('target', [GameUserApiController::class, 'target']);
    Route::patch('gamelogic', [GameLogicController::class, 'gotKilledUser']);
    Route::apiResource('messages', MessageApiController::class)->only(['index', 'store', 'destroy']);
    Route::get('allusers', [UserApiController::class, 'allUsers']);
    Route::middleware('role:spelbegeleider')->group(function () {
        Route::prefix('admin')->group(function (){
            Route::patch('gamelogic', [GameLogicController::class, 'gotKilledAdmin']);
            Route::get('users', [UserApiController::class, 'index']);
        });
    });
});*/

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/profile', [UserApiController::class, 'profile']);
    Route::get('/users', [UserApiController::class, 'index']);
    Route::get('/teams', [TeamApiController::class, 'index']);
    Route::post('/teams', [TeamApiController::class, 'store']);
    Route::get('/teams/my', [TeamApiController::class, 'myTeams']);
    Route::get('/games', [GameApiController::class, 'index']);
    Route::get('/games/scores', [GameApiController::class, 'showAllScores']);
    Route::get('/games/my', [GameApiController::class, 'myGames']);
    Route::get('/games/{id}', [GameApiController::class, 'show']);
    Route::post('/games', [GameApiController::class, 'store']);
    Route::get('/tables', [TableApiController::class, 'index']);
    Route::get('/tables/{id}', [TableApiController::class, 'show']);
    //Route::get('/tables/{id}/scores', [TableApiController::class, 'showScores']);
});

Route::get('/tables/{id}/start', [TableApiController::class, 'start']);
Route::get('/tables/{id}/end', [TableApiController::class, 'end']);
Route::get('/tables/{id}/scores', [TableApiController::class, 'showScores']);
Route::patch('/tables/{tableId}/teams/{teamId}', [GameinfoApiController::class, 'update']);
Route::post('/register', [UserApiController::class, 'store']);
