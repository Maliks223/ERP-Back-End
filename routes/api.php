<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KPIController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\ProjectController;

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
Route::resource('teamproject', TeamProjectController::class);




Route::get('/get', [AuthController::class, 'get']);
// Route::prefix('users')->middleware(['auth', 'SuperAdmin'])->group(function () {
// });
Route::post('/register', [AuthController::class, 'register']);
Route::resource('/project', ProjectController::class);
Route::resource('/roles', RoleController::class);
Route::resource('/employeerole', EmployeeRoleController::class);




//user routes
Route::get('/users', [AuthController::class, 'get']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::resource('/users', AuthController::class);

//teams routes
Route::resource('/teams', TeamController::class);

//employees routes
Route::resource('/employees', EmployeeController::class);

//middleware authentication
Route::group(['middleware' => 'auth.jwt'], function () {
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('employeekpi', EmployeeKPIController::class);


Route::resource('/kpi', KPIController::class);