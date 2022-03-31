<?php

namespace App\Http\Controllers;

use App\Models\SubPedido;
use Illuminate\Http\Request;

class SubPedidoController extends Controller
{

    public function index()
    {
        $subPedidos = SubPedido::all();
        if (is_object($subPedidos)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'subPedidos' => $subPedidos,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedidos no encontrados',
            ];
        }
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|integer',
            'proveedor_id' => 'integer',
            'fecha_compra' => 'date',
            'fecha_entrega' => 'date',
            'total' => 'numeric', 
        ]);
        $subPedido = new SubPedido();
        $subPedido->pedido_id = $request->pedido_id ;
        $subPedido->proveedor_id = $request->proveedor_id ;
        $subPedido->fecha_compra = $request->fecha_compra ;
        $subPedido->fecha_entrega = $request->fecha_entrega ;
        $subPedido->total = $request->total ;
        $subPedido->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'SubPedido creado correctamente',
            'subPedido' => $subPedido,
        ];
        return response()->json($data);
    }


    public function show($id)
    {
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'subPedido' => $subPedido,
            ];
        } else {
            $data = [
                'satatus' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }

 
    public function update(Request $request,$id)
    {
        $request->validate([
            'pedido_id' => 'required|integer',
            'proveedor_id' => 'integer',
            'fecha_compra' => 'date',
            'fecha_entrega' => 'date',
            'total' => 'numeric', 
        ]);
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $subPedido = new SubPedido();
            $subPedido->pedido_id = $request->pedido_id ;
            $subPedido->proveedor_id = $request->proveedor_id ;
            $subPedido->fecha_compra = $request->fecha_compra ;
            $subPedido->fecha_entrega = $request->fecha_entrega ;
            $subPedido->total = $request->total ;
            $subPedido->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'SubPedido actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getItemsBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $items = $subPedido->items;
            if(!is_null($items)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Items no encontrados',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getPedidoBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $pedido = $subPedido->pedido;
            if(!is_null($pedido)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Pedido no encontrados',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getProveedorBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $proveedor = $subPedido->proveedor;
            if(!is_null($proveedor)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Proveedor no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getFacturasBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $facturas = $subPedido->facturas;
            if(!is_null($facturas)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Facturas no encontradas',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }



    public function getNotasBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $notas = $subPedido->notas;
            if(!is_null($notas)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Notas no encontradas',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getRemitosBySubPedido($id){
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $remitos = $subPedido->remitos;
            if(!is_null($remitos)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'subPedido' => $subPedido,
                ];
            }else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Remitos no encontradas',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'SubPedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $subPedido = SubPedido::find($id);
        if (is_object($subPedido)) {
            $subPedido->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message'  => 'SubPedido eliminado correctamente',   
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message'  => 'SubPedido no encontrado',   
            ];
        }
        return response()->json($data);
    }

}
