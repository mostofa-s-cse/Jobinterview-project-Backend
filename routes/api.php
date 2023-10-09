<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;

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
    /*
    |--------------------------------------------------------------------------
    | auth prefix
    |--------------------------------------------------------------------------
    |
    */
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        //Login route----------------->http://127.0.0.1:8000/api/v1/auth/login
        Route::post('/login', [AuthController::class, 'login']);
        //register route-----------------------------------------------
        Route::post('/register', [AuthController::class, 'register']);
        //login user-profile get route-------------------------------------
        Route::post('me', [AuthController::class,'me']);
        //All user-List get route-------------------------------------
        //refresh route----------------------------------------------------
        Route::post('/refresh', [AuthController::class,'refresh']);
        //Logout route----------------------------------------------------
        Route::post('logout', [AuthController::class,'logout']);
        
    });

});
    Route::prefix('v1')->middleware(['auth','isAdmin'])->group(function(){
    //Get All Employee route----------------------------------------------------
    Route::get('/getallemployee', [UserController::class, 'getallemployee']);
    });
