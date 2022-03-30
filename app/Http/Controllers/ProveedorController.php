<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\ProveedorBanco;
use App\Models\ProveedorNota;
use Illuminate\Http\Request;


class ProveedorController extends Controller
{
    
    public function index()
    {
        $proveedores = Proveedor::all();
        if (is_object($proveedores)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'proveedores' => $proveedores,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedores no encontrados',
            ];
        }
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cuit' => 'string|max:100',
            'direccion'=> 'string|max:100',
            'telefono1'=> 'string|max:100',
            'telefono2'=> 'string|max:100',
            'razon_social'=> 'string|max:100',
            'provincia'=> 'string|max:100',
            'localidad'=> 'string|max:100',
            'comentario'=> 'string',
            'codigo'=> 'string|max:255',
            'email'=> 'string|email|max:255',
            'calificacion'=> 'integer',
        ]);
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->cuit = $request->cuit;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono1 = $request->telefono1;
        $proveedor->telefono2 = $request->telefono2;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->provincia = $request->provincia;
        $proveedor->localidad = $request->localidad;
        $proveedor->comentario = $request->comentario;
        $proveedor->codigo = $request->codigo;
        $proveedor->email = $request->email;
        $proveedor->calificacion = $request->calificacion;
        $proveedor->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Proveedor creado correctante',
        ];
        return response()->json($data);
    }


    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (is_object($proveedor)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'proveedor' => $proveedor,
            ];
        } else {
            $data  = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado'
            ];
        }
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cuit' => 'string|max:100',
            'direccion'=> 'string|max:100',
            'telefono1'=> 'string|max:100',
            'telefono2'=> 'string|max:100',
            'razon_social'=> 'string|max:100',
            'provincia'=> 'string|max:100',
            'localidad'=> 'string|max:100',
            'comentario'=> 'string',
            'codigo'=> 'string|max:255',
            'email'=> 'string|email|max:255',
            'calificacion'=> 'integer',
        ]);
        $proveedor = Proveedor::find($id);
        if (is_object($proveedor)) {
            $proveedor->nombre = $request->nombre;
            $proveedor->cuit = $request->cuit;
            $proveedor->direccion = $request->direccion;
            $proveedor->telefono1 = $request->telefono1;
            $proveedor->telefono2 = $request->telefono2;
            $proveedor->razon_social = $request->razon_social;
            $proveedor->provincia = $request->provincia;
            $proveedor->localidad = $request->localidad;
            $proveedor->comentario = $request->comentario;
            $proveedor->codigo = $request->codigo;
            $proveedor->email = $request->email;
            $proveedor->calificacion = $request->calificacion;
            $proveedor->save();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Proveedor actualizado correctante',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        if (is_object($proveedor)) {
            $proveedor->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Proveedor eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado',
            ];
        }
        return response()->json($data);
    }

    public function getProveedorByname($name){
        $proveedor = Proveedor::where('nombre','Like','%'.$name.'%')->first();
        if (!is_null($proveedor)) {
            $proveedores = Proveedor::where('nombre','Like','%'.$name.'%')->get();
            $data = [
                'status' => 'success',
                'code' => 200,
                'rubros' => $proveedores,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getBancosByProveedor($id){
        $proveedor = Proveedor::find($id);
        if (is_object($proveedor)) {
            $bancos = $proveedor->bancos();
            if (!is_null($bancos)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'proveedor' => $proveedor,
                    'bancos' => $bancos,
                ];
            } else {
                $data  = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Bancos no encontradas'
                ];
            }
        } else {
            $data  = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado'
            ];
        }
        return response()->json($data);
    }


    public function getNotasByProveedor($id){
        $proveedor = Proveedor::find($id);
        if (is_object($proveedor)) {
            $notas = $proveedor->notas();
            if (!is_null($notas)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'proveedor' => $proveedor,
                    'notas' => $notas,
                ];
            } else {
                $data  = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Notas no encontradas'
                ];
            }   
        } else {
            $data  = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Proveedor no encontrado'
            ];
        }
        return response()->json($data);
    }




}
