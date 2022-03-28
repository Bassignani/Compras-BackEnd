<?php

use App\Http\Controllers\EmpresaBancoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorBancoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorNotaController;
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
    Route::get('users/empresas/{id}', [UserController::class, 'getUsersByEmpresaID']);

    //Empresa
    Route::post('empresas/create', [EmpresaController::class, 'store']); 
    Route::put('empresas/update/{id}', [EmpresaController::class, 'update']); 
    Route::get('empresas/list', [EmpresaController::class, 'index']);
    Route::get('empresas/show/{id}', [EmpresaController::class, 'show']);
    Route::get('empresas/search-name/{nombre}', [EmpresaController::class, 'getEmpresaByName']);
    Route::get('empresas/search-cuit/{cuit}', [EmpresaController::class, 'getEmpresaByCuit']);
    Route::get('empresas/search-code/{codigo}', [EmpresaController::class, 'getEmpresaByCode']);
    Route::get('empresas/search-businessname/{razon_social}', [EmpresaController::class, 'getEmpresaByBusinessName']);
    Route::delete('empresas/destroy/{id}', [EmpresaController::class, 'destroy']);  

    //EmpresaBanco
    Route::post('empresas/bancos/create', [EmpresaBancoController::class, 'store']);
    Route::get('empresas/bancos/list', [EmpresaBancoController::class, 'index']);
    Route::get('empresas/bancos/show/{id}', [EmpresaBancoController::class, 'show']);
    Route::put('empresas/bancos/update/{id}', [EmpresaBancoController::class, 'update']);
    Route::get('empresas/bancos/search-empresa/{id}', [EmpresaBancoController::class, 'getBancosByEmpresaID']);
    Route::get('empresas/bancos/search-name/{name}', [EmpresaBancoController::class, 'getBancoByName']);
    Route::delete('empresas/bancos/{id}', [EmpresaBancoController::class, 'destroy']);

    //Proveedor
    Route::post('proveedores/create', [ProveedorController::class, 'store']);
    Route::get('proveedores/list', [ProveedorController::class, 'index']);
    Route::get('proveedores/show/{id}', [ProveedorController::class, 'show']);
    Route::put('proveedores/update/{id}', [ProveedorController::class, 'update']);
    Route::delete('proveedores/{id}', [ProveedorController::class, 'destroy']);
});


