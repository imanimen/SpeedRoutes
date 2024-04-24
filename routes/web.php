<?php

use Imanimen\SpeedRoutes\src\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{action}', BaseController::class);
Route::post('/{action}', BaseController::class);
Route::patch('/{action}', BaseController::class);
Route::delete('/{action}', BaseController::class);