<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\TeamController;
=======
use App\Http\Controllers\KPIController;
>>>>>>> dev
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


<<<<<<< HEAD
        });
        Route::resource('/employees',EmployeeController::class);
        Route::resource('/teams',TeamController::class);
=======

Route::get('/get', [AuthController::class, 'get']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
>>>>>>> dev


Route::resource('/employees', EmployeeController::class);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('/kpi', KPIController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
