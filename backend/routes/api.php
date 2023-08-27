<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ImageController;
use App\Http\Controllers\Api\V1\RentController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VehicleController;
use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Middleware\OnlyCommonMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::middleware('auth:sanctum')->group(function(){

        Route::middleware(OnlyAdminMiddleware::class)->group(function(){
            Route::get('/users', [UserController::class, 'index']);
            Route::get('/users/{user}', [UserController::class, 'show']);
            Route::post('/users/admin', [UserController::class, 'storeAdmin']);

            Route::post('/categories', [CategoryController::class, 'store']);
            Route::put('/categories/{category}', [CategoryController::class, 'update']);
            Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

            Route::post('/vehicles', [VehicleController::class, 'store']);
            //POST no update para conseguir atualizar a imagem
            Route::post('/vehicles/{vehicle}', [VehicleController::class, 'update']);
            Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);
        });

        Route::middleware(OnlyCommonMiddleware::class)->group(function(){
            Route::post('/rents', [RentController::class, 'store']);
            Route::delete('/rents/{rent}', [RentController::class, 'destroy']);
        });

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/users', [UserController::class, 'store']);

    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);


    Route::get('/rents', [RentController::class, 'index']);
    Route::get('/rents/user/{id}', [RentController::class, 'indexUser']);
    Route::get('/rents/{rent}', [RentController::class, 'show']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);


});

