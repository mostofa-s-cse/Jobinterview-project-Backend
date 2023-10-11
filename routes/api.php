<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\EmployeeActivitiesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        //Login route----------------->
        Route::post('/login', [AuthController::class, 'login']); // http://127.0.0.1:8000/api/v1/auth/login
        //login user-profile get route-------------------------------------
        Route::post('me', [AuthController::class,'me']); //http://127.0.0.1:8000/api/v1/auth/me  with bearer token
        //refresh route----------------------------------------------------
        Route::post('/refresh', [AuthController::class,'refresh']);
        //Logout route----------------------------------------------------
        Route::post('logout', [AuthController::class,'logout']); //http://127.0.0.1:8000/api/v1/auth/me  with bearer token
    });
});

// this route only access Owner---------------------------------------------------------------------------------------------------
Route::group([
    'prefix' => 'v1/auth',
    'middleware' => 'isAdmin'
], function ($router) {
    Route::get('employee-list', [UserController::class,'getallemployee']); //http://127.0.0.1:8000/api/v1/auth/employee-list   with bearer token
    Route::post('individual-employee', [UserController::class,'getIndividualEmployee']); //http://127.0.0.1:8000/api/v1/auth/individual-employee   with bearer token
    Route::post('search-employee-report', [UserController::class,'searchEmployeeReport']); //http://127.0.0.1:8000/api/v1/auth/search-employee-report   with bearer token
    //register route-----------------------------------------------
    Route::post('register', [AuthController::class, 'register']); //http://127.0.0.1:8000/api/v1/auth/register with bearer token
    
});

// Employee Routes---------------------------------------------------------------------------------------------------
Route::get('v1/employee-checkIn', [EmployeeActivitiesController::class,'checkIn']); //http://127.0.0.1:8000/api/v1/employee-checkIn     with bearer token
Route::get('v1/employee-checkOut', [EmployeeActivitiesController::class,'checkOut']); //http://127.0.0.1:8000/api/v1/employee-checkOut     with bearer token
Route::get('v1/employee-checkIn-check', [EmployeeActivitiesController::class,'checkIn_check']); //http://127.0.0.1:8000/api/v1/employee-checkIn-check   with bearer token
