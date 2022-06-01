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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::resource('games', GameWebController::class);
Route::resource('messages', MessageWebController::class);
Route::resource('roles', RoleWebController::class);
Route::resource('users', UserWebController::class);
Route::resource('games', WeaponWebController::class);

Route::prefix('games')->group(function () {
    Route::post('{id}/pause', [GameWebController::class, 'pause'])->whereNumber('id');
    Route::post('{id}/start', [GameWebController::class, 'start'])->whereNumber('id');
});
Route::get('/', [GameWebController::class,'index']);

Route::prefix('api')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});
