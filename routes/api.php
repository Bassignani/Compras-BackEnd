<?php

use App\Http\Controllers\EmpresaBancoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorBancoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorNotaController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

   
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    //User
    Route::get('users/profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::put('users/edit', [UserController::class, 'edit']);
    Route::put('users/update/{id}', [UserController::class, 'update']);
    Route::get('users', [UserController::class, 'index']); 
    // Route::get('users/empresas/{id}', [UserController::class, 'getUsersByEmpresaID']);
    Route::get('users/pedidos_creados/{id}', [UserController::class, 'getPedidosCreadosByUser']);
    Route::get('users/pedidos_recibidos/{id}', [UserController::class, 'getPedidosRecibidosByUser']);
    Route::get('users/empresa/{id}', [UserController::class, 'getEmpresaByUser']);


    //Empresa
    Route::post('empresas/create', [EmpresaController::class, 'store']); 
    Route::put('empresas/update/{id}', [EmpresaController::class, 'update']); 
    Route::get('empresas/list', [EmpresaController::class, 'index']);
    Route::get('empresas/show/{id}', [EmpresaController::class, 'show']);
    Route::get('empresas/search-name/{nombre}', [EmpresaController::class, 'getEmpresaByName']);
    Route::get('empresas/search-cuit/{cuit}', [EmpresaController::class, 'getEmpresaByCuit']);
    Route::get('empresas/search-code/{codigo}', [EmpresaController::class, 'getEmpresaByCode']);
    Route::get('empresas/search-businessname/{razon_social}', [EmpresaController::class, 'getEmpresaByBusinessName']);
    Route::get('empresas/users/{id}', [EmpresaController::class, 'getUsersByEmpresa']);
    Route::get('empresas/bancos/{id}', [EmpresaController::class, 'getBancosByEmpresa']);
    Route::get('empresas/pedidos/{id}', [EmpresaController::class, 'getPedidosByEmpresa']);
    Route::delete('empresas/destroy/{id}', [EmpresaController::class, 'destroy']);  

    //Empresa Banco
    Route::post('empresas/bancos/create', [EmpresaBancoController::class, 'store']);
    Route::get('empresas/bancos/list', [EmpresaBancoController::class, 'index']);
    Route::get('empresas/bancos/show/{id}', [EmpresaBancoController::class, 'show']);
    Route::put('empresas/bancos/update/{id}', [EmpresaBancoController::class, 'update']);
    Route::get('empresas/bancos/search-empresa/{id}', [EmpresaBancoController::class, 'getBancosByEmpresaID']);
    Route::get('empresas/bancos/search-name/{name}', [EmpresaBancoController::class, 'getBancoByName']);
    Route::delete('empresas/bancos/{id}', [EmpresaBancoController::class, 'destroy']);
    // Route::get('empresas/bancos/{id}', [EmpresaBancoController::class, 'getEmpresaByBanco']);

    //Proveedor
    Route::post('proveedores/create', [ProveedorController::class, 'store']);
    Route::get('proveedores/list', [ProveedorController::class, 'index']);
    Route::get('proveedores/show/{id}', [ProveedorController::class, 'show']);
    Route::put('proveedores/update/{id}', [ProveedorController::class, 'update']);
    Route::delete('proveedores/{id}', [ProveedorController::class, 'destroy']);
    Route::get('proveedores/search-name/{name}', [ProveedorController::class, 'getProveedorByname']);
    Route::get('proveedores/bancos/{id}', [ProveedorController::class, 'getBancosByProveedor']);
    Route::get('proveedores/notas/{id}', [ProveedorController::class, 'getNotasByProveedor']);

    //Proveedor Banco
    Route::post('proveedores/bancos/create', [ProveedorBancoController::class, 'store']);
    Route::get('proveedores/bancos/list', [EmpresaBanProveedorBancoControllercoController::class, 'index']);
    Route::get('proveedores/bancos/show/{id}', [ProveedorBancoController::class, 'show']);
    Route::put('proveedores/bancos/update/{id}', [ProveedorBancoController::class, 'update']);
    Route::delete('proveedores/bancos/{id}', [ProveedorBancoController::class, 'destroy']);

    //Proveedor Nota
    Route::post('proveedores/notas/create', [ProveedorNotaController::class, 'store']);
    Route::get('proveedores/notas/list', [ProveedorNotaController::class, 'index']);
    Route::get('proveedores/notas/show/{id}', [ProveedorNotaController::class, 'show']);
    Route::put('proveedores/notas/update/{id}', [ProveedorNotaController::class, 'update']);
    Route::delete('proveedores/notas/{id}', [ProveedorNotaController::class, 'destroy']);

    //Rubro
    Route::get('rubros/list', [RubroController::class, 'index']);
    Route::post('rubros/create', [RubroController::class, 'store']);
    Route::get('rubros/show/{id}', [RubroController::class, 'show']);
    Route::put('rubros/update/{id}', [RubroController::class, 'update']);
    Route::delete('rubros/{id}', [RubroController::class, 'destroy']);
    Route::get('rubros/search-name/{name}', [RubroController::class, 'getRubroByname']);
    Route::get('rubros/proveedores/{id}', [RubroController::class, 'getProveedoresByRubro']);
});


