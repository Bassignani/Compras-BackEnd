<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::all();
        if (is_object($items)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'items' => $items,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Items no encontrados',
            ];
        }
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|integer',
            'rubro_id' => 'integer',
            'marca' => 'string|max:255',
            'descripcion' => 'string|max:255',
            'cantidad' => 'integer',
            'precio' => 'numeric',
            'estado' => 'string|max:255',    
        ]);
        $item = new Item();
        $item->pedido_id = $request->pedido_id;
        $item->rubro_id = $request->rubro_id;
        $item->marca = $request->marca;
        $item->descripcion = $request->descripcion;
        $item->cantidad = $request->cantidad;
        $item->precio = $request->precio;
        $item->estado = $request->estado;
        $item->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Item creado correctamente',
            'item' => $item,
        ];
        return response()->json($data);
    }


    public function show($id)
    {
        $item = Item::find($id);
        if (is_object($item)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'item' => $item,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado', 
            ];
        }
        return response()->json($data);
    }

 
    public function update(Request $request,$id)
    {
        $request->validate([
            'pedido_id' => 'required|integer',
            'rubro_id' => 'integer',
            'marca' => 'string|max:255',
            'descripcion' => 'string|max:255',
            'cantidad' => 'integer',
            'precio' => 'numeric',
            'estado' => 'string|max:255',    
        ]);
        $item = Item::find($id);
        if (is_object($item)) {
            $item->rubro_id = $request->rubro_id;
            $item->marca = $request->marca;
            $item->descripcion = $request->descripcion;
            $item->cantidad = $request->cantidad;
            $item->precio = $request->precio;
            $item->estado = $request->estado;
            $item->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Item actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getPedidoByItem($id){
        $item = Item::find($id);
        if (is_object($item)) {
            $pedido = $item->pedido;
            if (!is_null($pedido)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'item' => $item,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Pedido no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getRubroByItem($id){
        $item = Item::find($id);
        if (is_object($item)) {
            $rubro = $item->rubro;
            if (!is_null($rubro)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'item' => $item,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Rubro no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getSubPedidosByItem($id){
        $item = Item::find($id);
        if (is_object($item)) {
            $subPedidos = $item->subPedidos;
            if (!is_null($subPedidos)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'item' => $item,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'SubPedidos no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $item = Item::find($id);
        if (is_object($item)) {
            $item->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Item eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Item no encontrado',
            ];
        }
        
    }
}
