<?php

namespace App\Http\Controllers;

use App\Models\SubPedidoNota;
use Illuminate\Http\Request;

class SubPedidoNotaController extends Controller
{
  
    public function index()
    {
        $notas = SubPedidoNota::all();
        if (is_object($notas)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'notas' => $notas,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Nota no encontrada',
            ];
        }
        
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required',
            'nota' => 'required|string|max:255',
        ]);
        $nota = new SubPedidoNota(); 
        $nota->subPedido_id = $request->subPedido_id;
        $nota->descripcion = $request->descripcion;
        $nota->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Nota creada correctamente',
            'nota' => $nota,
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $nota = SubPedidoNota::find($id);
        if (is_object($nota)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'nota' => $nota, 
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Nota no encontrada', 
            ];
        }
        return response()->json($data);
    }


   

    public function update(Request $request,$id)
    {
        $request->validate([
            'subPedido_id' => 'subPedido_id',
            'descripcion' => 'required|string|max:255',
        ]);
        $nota = SubPedidoNota::find($id);
        if (is_object($nota)) {
            $nota->descripcion = $request->descripcion;
            $nota->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Nota actualizada correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Nota no encontrada',
            ];
        }
        return response()->json($data);
    }

 
    public function destroy($id)
    {
        $nota = SubPedidoNota::find($id);
        if (is_object($nota)) {
            $nota->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'NOta eliminada correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'NOta no encontrada',
            ];
        }
        return response()->json($data);
    }
}
