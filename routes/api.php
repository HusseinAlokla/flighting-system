<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
//CRUD for user
//Route::apiResource('users', UserController::class);

//CRUD for flights
//Route::apiResource('flights', FlightController::class);
Route::group(['middleware' => ['role:admin']], function () {
    Route::apiResource('users', UserController::class);
    // Any other admin routes
});

Route::group(['middleware' => ['permission:manage flights']], function () {
    Route::apiResource('flights', FlightController::class);
    // Routes requiring "manage flights" permission
});


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);