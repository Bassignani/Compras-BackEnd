<?php

use App\Http\Controllers\EmpresaBancoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemSubpedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProveedorBancoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorNotaController;
use App\Http\Controllers\ProveedorRubroController;
use App\Http\Controllers\RemitoController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\SubPedidoController;
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
    Route::get('empresas/bancos/search-name/{name}/{id}', [EmpresaBancoController::class, 'getBancoByName']);
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
    Route::get('proveedores/rubros/{id}', [ProveedorController::class, 'getRubrosByProveedor']);

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

    //Proveedor Rubro
    Route::post('proveedor_rubro', [ProveedorRubroController::class, 'store']);

    //Pedidos
    Route::post('pedidos/create', [PedidoController::class, 'store']);
    Route::get('pedidos/list', [PedidoController::class, 'index']);
    Route::get('pedidos/show/{id}', [PedidoController::class, 'show']);
    Route::put('pedidos/update/{id}', [PedidoController::class, 'update']);
    Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);
    Route::get('pedidos/items/{id}', [PedidoController::class, 'getItemsByPedido']);
    Route::get('pedidos/sub-pedidos/{id}', [PedidoController::class, 'getSubPedidosByPedido']);
    Route::get('pedidos/empresa/{id}', [PedidoController::class, 'getEmpresaByPedido']);
    Route::get('pedidos/user-creador/{id}', [PedidoController::class, 'getUsuarioCreadorByPedido']);
    Route::get('pedidos/user-recepcion/{id}', [PedidoController::class, 'getUsuarioRecepcionByPedido']);

    //SubPedidos
    Route::post('subpedidos/create', [SubPedidoController::class, 'store']);
    Route::get('subpedidos/list', [SubPedidoController::class, 'index']);
    Route::get('subpedidos/show/{id}', [SubPedidoController::class, 'show']);
    Route::put('subpedidos/update/{id}', [SubPedidoController::class, 'update']);
    Route::delete('subpedidos/{id}', [SubPedidoController::class, 'destroy']);
    Route::get('subpedidos/items/{id}', [SubPedidoController::class, 'getItemsBySubPedido']);
    Route::get('subpedidos/pedido/{id}', [SubPedidoController::class, 'getPedidoBySubPedido']);
    Route::get('subpedidos/proveedor/{id}', [SubPedidoController::class, 'getProveedorBySubPedido']);
    Route::get('subpedidos/facturas/{id}', [SubPedidoController::class, 'getFacturasBySubPedido']);
    Route::get('subpedidos/notas/{id}', [SubPedidoController::class, 'getNotasBySubPedido']);
    Route::get('subpedidos/remitos/{id}', [SubPedidoController::class, 'getRemitosBySubPedido']);

    //Item Subpedido
    Route::post('item_subpedido', [ItemSubpedidoController::class, 'store']);

    //Items
    Route::post('items/create', [ItemController::class, 'store']);
    Route::get('items/list', [ItemController::class, 'index']);
    Route::get('items/show/{id}', [ItemController::class, 'show']);
    Route::put('items/update/{id}', [ItemController::class, 'update']);
    Route::delete('items/{id}', [ItemController::class, 'destroy']);
    Route::get('items/pedido/{id}', [ItemController::class, 'getPedidoByItem']);
    Route::get('items/rubro/{id}', [ItemController::class, 'getRubroByItem']);
    Route::get('items/subpedido/{id}', [ItemController::class, 'getSubPedidosByItem']);

    //SubPedidos Notas
    Route::post('subpedidos/notas/create', [ProveedorNotaController::class, 'store']);
    Route::get('subpedidos/notas/list', [ProveedorNotaController::class, 'index']);
    Route::get('subpedidos/notas/show/{id}', [ProveedorNotaController::class, 'show']);
    Route::put('subpedidos/notas/update/{id}', [ProveedorNotaController::class, 'update']);
    Route::delete('subpedidos/notas/{id}', [ProveedorNotaController::class, 'destroy']);

    //Remito
    Route::post('remitos/create', [RemitoController::class, 'store']);
    Route::get('remitos/list', [RemitoController::class, 'index']);
    Route::get('remitos/show/{id}', [RemitoController::class, 'show']);
    Route::put('remitos/update/{id}', [RemitoController::class, 'update']);
    Route::delete('remitos/{id}', [RemitoController::class, 'destroy']);

    //Factura
    Route::post('facturas/create', [FacturaController::class, 'store']);
    Route::get('facturas/list', [FacturaController::class, 'index']);
    Route::get('facturas/show/{id}', [FacturaController::class, 'show']);
    Route::put('facturas/update/{id}', [FacturaController::class, 'update']);
    Route::delete('facturas/{id}', [FacturaController::class, 'destroy']);
    Route::get('facturas/subpedido/{id}', [FacturaController::class, 'getSubPedidoByFactura']);

    //Pago
    Route::post('pagos/create', [PagoController::class, 'store']);
    Route::get('pagos/list', [PagoController::class, 'index']);
    Route::get('pagos/show/{id}', [PagoController::class, 'show']);
    Route::put('pagos/update/{id}', [PagoController::class, 'update']);
    Route::delete('pagos/{id}', [PagoController::class, 'destroy']);
    Route::get('pagos/factura/{id}', [PagoController::class, 'shogetFacturaByPagow']);
    Route::get('pagos/cheques/{id}', [PagoController::class, 'getChequesByPago']);

    //Cheques
    Route::post('cheques/create', [PagoController::class, 'store']);
    Route::get('cheques/list', [PagoController::class, 'index']);
    Route::get('cheques/show/{id}', [PagoController::class, 'show']);
    Route::put('cheques/update/{id}', [PagoController::class, 'update']);
    Route::delete('cheques/{id}', [PagoController::class, 'destroy']);
    Route::get('cheques/pago/{id}', [PagoController::class, 'getPagoByCheque']);
});


