<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresas = Empresa::all();
        if (is_object($empresas)) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresas' => $empresas,
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se han encontrado empresas',
            );
        }
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cuit' => 'required|string|max:100',
            'razon_social' => 'string|max:255',
            'direccion' => 'string|max:255',
            'telefono1' => 'string|max:255',
            'telefono2' => 'string|max:255',
            'codigo'    => 'string|max:255',
            'path_img'  => 'string|max:255',
        ]);  
        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->cuit = $request->cuit;
        $empresa->razon_social = $request->razon_social;
        $empresa->direccion = $request->direccion;
        $empresa->telefono1 = $request->telefono1;
        $empresa->telefono2 = $request->telefono2;
        $empresa->codigo = $request->codigo;
        $empresa->path_img = $request->path_img;
        $empresa->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Empresa creada correctamente',
        ]; 
        return response()->json($data);
    }


    public function show(Request $request,$id)
    {
        $empresa = Empresa::find($id);
        if (is_object($empresa)) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => $empresa,
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado la empresa',
            );
        }
        return response()->json($data);
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cuit' => 'required|string|max:100',
            'razon_social' => 'string|max:255',
            'direccion' => 'string|max:255',
            'telefono1' => 'string|max:255',
            'telefono2' => 'string|max:255',
            'codigo'    => 'string|max:255',
            'path_img'  => 'string|max:255',
        ]);  
        $empresa = Empresa::find($id);
        if (is_object($empresa)) {
            $empresa->nombre = $request->nombre;
            $empresa->cuit = $request->cuit;
            $empresa->razon_social = $request->razon_social;
            $empresa->direccion = $request->direccion;
            $empresa->telefono1 = $request->telefono1;
            $empresa->telefono2 = $request->telefono2;
            $empresa->codigo = $request->codigo;
            $empresa->path_img = $request->path_img;
            $empresa->save();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => 'Empresa actualizada correctamente',
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado la empresa',
            );
        }
        return response()->json($data);
    }


    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        if (is_object($empresa)) {
            $empresa->delete();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Empresa eliminada correctamente'
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado la empresa',
            );
        }
        return response()->json($data);
    }
}
