<?php

use App\Http\Controllers\GameWebController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageWebController;
use App\Http\Controllers\RoleWebController;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\WeaponWebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::prefix('games')->group(function () {
        Route::post('{id}/pause', [GameWebController::class, 'pause'])->whereNumber('id');
        Route::post('{id}/unpause', [GameWebController::class, 'unpause'])->whereNumber('id');
        Route::post('', [GameWebController::class, 'store']);
        Route::post('{id}', [GameWebController::class, 'update'])->whereNumber('id');
        Route::get('/create', [GameWebController::class, 'create']);
        Route::get('{id}', [GameWebController::class, 'show'])->whereNumber('id');
        Route::get('{id}/leaderboard', [GameWebController::class, 'leaderboard'])->whereNumber('id');
        Route::get('{id}/edit', [GameWebController::class, 'edit'])->whereNumber('id');
    });

    Route::prefix('users')->group(function () {
        Route::post('{id}/kill', [UserWebController::class, 'kill'])->whereNumber('id');
    });

    Route::get('/', [GameWebController::class, 'index']);
});*/

Route::prefix('api')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::get('/', function () {
    return redirect('/api/documentation');
});

require __DIR__.'/auth.php';
