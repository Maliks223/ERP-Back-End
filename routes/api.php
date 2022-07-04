<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EmployeeController,
    AuthController,
    KPIController,
    ProjectController,
    TeamProjectController,
};


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

Route::resource('/project', ProjectController::class);
// Route::resource('/project', TeamProjectController::class);
Route::resource('teamproject', TeamProjectController::class);




Route::get('/get', [AuthController::class, 'get']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::resource('/teams', TeamController::class);

Route::resource('/employees', EmployeeController::class);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('/kpi', KPIController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('employeekpi', EmployeeKPIController::class);