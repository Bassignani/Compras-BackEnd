<?php

namespace App\Http\Controllers;

use App\Models\ItemSubpedido;
use Illuminate\Http\Request;


class ItemSubpedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'subPedido_id' => 'required|integer',
            
        ]);
        $item_subpedido = new ItemSubpedido();
        $item_subpedido->item_id = $request->item_id;
        $item_subpedido->subPedido_id = $request->subPedido_id;
        $item_subpedido->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'item_subpedido creado correctante',
            'item_subpedido' => $item_subpedido,
        ];
        return response()->json($data);
    }
}
