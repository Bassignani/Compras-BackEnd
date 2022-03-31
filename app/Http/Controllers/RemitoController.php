<?php

namespace App\Http\Controllers;

use App\Models\Remito;
use Illuminate\Http\Request;

class RemitoController extends Controller
{
    
    public function index()
    {
        $remitos = Remito::all();
        if (is_object($remitos)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'remitos' => $remitos,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Remitos no encontrados',
            ];
        }
        
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'subPedido_id'  => 'required|integer',
            'num_remito' => 'required|string|max:255',
            'nota' => 'string|max:255',
            'fecha' => 'date',
            'archivo' => 'string|max:255',
        ]);
        $remito = new Remito(); 
        $remito->subPedido_id = $request->subPedido_id;
        $remito->num_remito = $request->num_remito;
        $remito->nota = $request->nota;
        $remito->fecha = $request->fecha;
        $remito->archivo = $request->archivo;
        $remito->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Remito creado correctamente',
            'remito' => $remito,
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $remito = Remito::find($id);
        if (is_object($remito)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'remito' => $remito, 
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Remito no encontrado', 
            ];
        }
        return response()->json($data);
    }


   

    public function update(Request $request,$id)
    {
        $request->validate([
            'subPedido_id'  => 'required|integer',
            'num_remito' => 'required|string|max:255',
            'nota' => 'string|max:255',
            'fecha' => 'date',
            'archivo' => 'string|max:255',
        ]);
        $remito = Remito::find($id);
        if (is_object($remito)) {
            $remito = new Remito(); 
            $remito->subPedido_id = $request->subPedido_id;
            $remito->num_remito = $request->num_remito;
            $remito->nota = $request->nota;
            $remito->fecha = $request->fecha;
            $remito->archivo = $request->archivo;
            $remito->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Remito actualizada correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Remito no encontrado',
            ];
        }
        return response()->json($data);
    }

 
    public function destroy($id)
    {
        $remito = Remito::find($id);
        if (is_object($remito)) {
            $remito->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Remito eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Remito no encontrado',
            ];
        }
        return response()->json($data);
    }
}
