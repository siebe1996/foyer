<?php

use App\Http\Controllers\GameApiController;
use App\Http\Controllers\GameinfoApiController;
use App\Http\Controllers\GameLogicController;
use App\Http\Controllers\GameUserApiController;
use App\Http\Controllers\MessageApiController;
use App\Http\Controllers\TableApiController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $id = Auth::id();
    $u = User::with('roles')->findOrFail($id);
    $user = new UserResource(User::with('roles')->findOrFail($id));
    return response(['data' => $user, 'admin' => $u->hasRole('administrator')], 200)
        ->header('Content-Type', 'application/json');
});

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

Route::get('/table/{id}/start', [TableApiController::class, 'start']);
Route::get('/table/{id}/end', [TableApiController::class, 'end']);
Route::patch('/table/{tableId}/team/{teamId}', [GameinfoApiController::class, 'update']);

