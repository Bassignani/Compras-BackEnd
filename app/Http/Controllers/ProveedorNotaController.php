<?php

namespace App\Http\Controllers;

use App\Models\ProveedorNota;
use Illuminate\Http\Request;

class ProveedorNotaController extends Controller
{
    public function index()
    {
        $notas = ProveedorNota::all();
        if (is_object($notas)) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'bancos' => $notas,
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Notas no encontrados',
            );
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required',
            'nota' => 'required|string|max:255',
        ]);
        $nota = new ProveedorNota(); 
        $nota->proveedor_id = $request->proveedor_id;
        $nota->nota = $request->nota;
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
        $nota = ProveedorNota::find($id);
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

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'proveedor_id' => 'proveedor_id',
            'nota' => 'required|string|max:255',
        ]);
        $nota = ProveedorNota::find($id);
        if (is_object($nota)) {
            $nota->nota = $request->nota;
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
        $nota = ProveedorNota::find($id);
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
