<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;   //Importar controlador

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

Route::prefix("v1/auth")->group(function(){

    Route::post("login", [AuthController::class, "signIn"]);
    Route::post("registro", [AuthController::class, "register"]);

    Route::middleware('auth:sanctum')->group(function(){

        Route::get("perfil", [AuthController::class, "profile"]);
        Route::post("salir", [AuthController::class, "signOff"]);
        
    });

});



