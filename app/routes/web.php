<?php

use App\Http\Controllers\AboutWebController;
use App\Http\Controllers\ContactWebController;
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuWebController;
use App\Http\Controllers\MoodboardWebController;
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

/*Route::prefix('api')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::get('/', function () {
    return redirect('/api/documentation');
});*/
Route::get('/', [HomeWebController::class, 'index']);
Route::get('/about', [AboutWebController::class, 'index']);
Route::get('/menu', [MenuWebController::class, 'index']);
Route::get('/moodboard', [MoodboardWebController::class, 'index']);
Route::get('/contact', [ContactWebController::class, 'index']);

require __DIR__.'/auth.php';
