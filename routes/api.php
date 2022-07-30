<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\EmployeeKpiController;
use App\Http\Controllers\EvalutionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TeamProjectController;

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



//ALIGORITHIM (THE (MIND LOGIC) OF THE PROJECT)
//ABU AMER (THE HARDWORKING MINDSET AND FUCKING THE PROBLEMS TO GIVE BIRTH FOR SOLUTIONS)
//MALIKS (AKBAR DESIGNER MANYAK BL TERI5)


  //MIDDLWARE AUTHENTICATION
Route::group(['middleware' => 'auth.jwt'], function () {

 //user routes
Route::get('/users', [AuthController::class, 'get']);
Route::get('/getAdmin/{id}', [AuthController::class, 'getAdmin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::resource('/users', AuthController::class);
Route::get('/user',[AuthController::class,'getuser']);

 //employees routes
Route::resource('/employees', EmployeeController::class);

 //teams routes
Route::resource('/teams', TeamController::class);

 //EMPLOYEE KPI
Route::resource('employeekpi', EmployeeKpiController::class);

 // KPI
Route::resource('/kpi', KpiController::class);

 //EVALUTION ROUTES
Route::get('/evalution/{id}',[EvalutionController::class,'index']);
Route::post('/evalution',[EvalutionController::class,'store']);

//EMPLOYEE ROLE
Route::resource('/employeerole', EmployeeRoleController::class);

//PROJECT ROUTES
Route::resource('/project', ProjectController::class);

//ROLES ROUTES
Route::resource('/roles', RoleController::class);

//PROJECT
Route::resource('/project', ProjectController::class);

//TEAM PROJECT
Route::resource('/teamproject', TeamProjectController::class);

});

 //MIDDLWARE FOR SUPERADMIN REGISTERING ANEW ADMINS 
 Route::group(['middleware'=>['auth.jwt','SuperAdmin']], function(){
    //register only for SUPERADMIN
    Route::post('/register', [AuthController::class, 'register']);

});


//OUR TE5BIS AT THE STARTING OF THE PROJECT :)

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::resource('/projectreport', ReportController::class);

// Route::get('/get', [AuthController::class, 'index']);
// Route::prefix('users')->middleware(['auth', 'SuperAdmin'])->group(function () {
// });
// Route::resource('/evalution',EvalutionController::class);
// Route::get('get' , [AuthController::class, 'index']);