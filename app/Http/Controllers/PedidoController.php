<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
   
    public function index()
    {
        $pedidos = Pedido::all();
        if (is_object($pedidos)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'pedidos' => $pedidos,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'empresa_id' => 'required|integer',
            'user_recepcion_id' => 'integer',
            'fecha_entrega' => 'date',
            'num_pedido' => 'string|max:255',
            'estado' => 'string|max:255',
            'urgencia' => 'string|max:255',
        ]);
        $pedido = new Pedido();
        $pedido->user_id = $request->user_id;
        $pedido->empresa_id = $request->empresa_id;
        $pedido->user_recepcion_id = $request->user_recepcion_id;
        $pedido->fecha_entrega = $request->fecha_entrega;
        $pedido->num_pedido = $request->num_pedido;
        $pedido->estado = $request->estado;
        $pedido->urgencia = $request->urgencia;
        $pedido->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Pedido creado correctamente',
            'pedido' => $pedido,
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'pedido' => $pedido,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'empresa_id' => 'required|integer',
            'user_recepcion_id' => 'integer',
            'fecha_entrega' => 'date',
            'num_pedido' => 'string|max:255',
            'estado' => 'string|max:255',
            'urgencia' => 'string|max:255',
        ]);
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $pedido = new Pedido();
            $pedido->empresa_id = $request->empresa_id;
            $pedido->user_recepcion_id = $request->user_recepcion_id;
            $pedido->fecha_entrega = $request->fecha_entrega;
            $pedido->num_pedido = $request->num_pedido;
            $pedido->estado = $request->estado;
            $pedido->urgencia = $request->urgencia;
            $pedido->save();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Pedido actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'success',
                'code' => 404,
                'message' => 'Pedido creado correcta',
            ];
        }
        return response()->json($data);   
    }


    public function getItemsByPedido($id){
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $items = $pedido->items;
            if (!is_null($items)) {
                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'pedido' => $pedido,
                ];
            } else {
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
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    } 


    public function getSubPedidosByPedido($id){
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $items = $pedido->subPedidos;
            if (!is_null($items)) {
                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'pedido' => $pedido,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'SubPedidos no encontrados',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getEmpresaByPedido($id){
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $items = $pedido->empresa;
            if (!is_null($items)) {
                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'pedido' => $pedido,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Empresa no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }

    
    public function getUsuarioCreadorByPedido($id){
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $items = $pedido->usuarioCreador;
            if (!is_null($items)) {
                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'pedido' => $pedido,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'usuarioCreador no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getUsuarioRecepcionByPedido($id){
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $items = $pedido->usuarioRecepcion;
            if (!is_null($items)) {
                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'pedido' => $pedido,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'usuarioRecepcion no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        if (is_object($pedido)) {
            $pedido->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Pedido eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pedido no encontrado',
            ];
        }
        return response()->json($data);
    }
}
