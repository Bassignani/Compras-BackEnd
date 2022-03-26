<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

   
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    //USERS
    Route::get('users/profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::put('users/edit', [UserController::class, 'edit']);
    Route::put('users/update/{id}', [UserController::class, 'update']);
    Route::get('users', [UserController::class, 'index']);

    //Empresa
    Route::post('empresas/create', [EmpresaController::class, 'store']); 
    Route::put('empresas/update/{id}', [EmpresaController::class, 'update']); 
    Route::get('empresas/list', [EmpresaController::class, 'index']);
    Route::get('empresas/show/{id}', [EmpresaController::class, 'show']);
    Route::delete('empresas/destroy/{id}', [EmpresaController::class, 'destroy']);  
});


