<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrokersController;
use App\Http\Controllers\PropertiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/brokers',[BrokersController::class,'index']);
Route::get('/brokers/{broker}',[BrokersController::class,'show']);
Route::get('/properties',[PropertiesController::class,'index']);
Route::get('/properties/{property}',[PropertiesController::class,'show']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('brokers', BrokersController::class)
    ->only(['store','update','destroy']);
    Route::apiResource('/properties',PropertiesController::class)
    ->only(['store','update','destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
