<?php

namespace App\Http\Controllers;

use App\Models\ProveedorBanco;
use Illuminate\Http\Request;

class ProveedorBancoController extends Controller
{
    
    public function index()
    {
        $bancos = ProveedorBanco::all();
        if (is_object($bancos)) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'bancos' => $bancos,
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Bancos no encontrados',
            );
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required',
            'banco' => 'required|string|max:255',
            'num_cuenta' => 'string|max:255',
            'cbu' => 'string|max:255',
            'tipo_cuenta' => 'string|max:255',
            'alias' => 'string|max:255',
            'descripcion' => 'string|max:255',
        ]);
        $banco = new ProveedorBanco(); 
        $banco->proveedor_id = $request->proveedor_id;
        $banco->banco = $request->banco;
        $banco->num_cuenta = $request->num_cuenta;
        $banco->cbu = $request->cbu;
        $banco->tipo_cuenta = $request->tipo_cuenta;
        $banco->alias = $request->alias;
        $banco->descripcion = $request->descripcion;
        $banco->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Banco creado correctamente',
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $banco = ProveedorBanco::find($id);
        if (is_object($banco)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'banco' => $banco, 
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Banco no encontrado', 
            ];
        }
        return response()->json($data);
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'proveedor_id' => 'proveedor_id',
            'banco' => 'required|string|max:255',
            'num_cuenta' => 'string|max:255',
            'cbu' => 'string|max:255',
            'tipo_cuenta' => 'string|max:255',
            'alias' => 'string|max:255',
            'descripcion' => 'string|max:255',
        ]);
        $banco = ProveedorBanco::find($id);
        if (is_object($banco)) {
            $banco->banco = $request->banco;
            $banco->num_cuenta = $request->num_cuenta;
            $banco->cbu = $request->cbu;
            $banco->tipo_cuenta = $request->tipo_cuenta;
            $banco->alias = $request->alias;
            $banco->descripcion = $request->descripcion;
            $banco->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Banco actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Banco no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $banco = ProveedorBanco::find($id);
        if (is_object($banco)) {
            $banco->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Banco eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Banco no encontrado',
            ];
        }
        return response()->json($data);
    }
}
