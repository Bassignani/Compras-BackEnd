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
                'message' => 'Empresa no encontrada',
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
            'empresa' => $empresa,
        ]; 
        return response()->json($data);
    }


    public function show($id)
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
                'message' => 'Empresa no encontrada',
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
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    }


    public function getEmpresaByName($nombre){
        $empresa = Empresa::where('nombre','Like','%'.$nombre.'%')->first();
        if (!is_null($empresa)) {
            $empresa = Empresa::where('nombre','Like','%'.$nombre.'%')->get();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => $empresa,
            );
        }else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    } 


    public function getEmpresaByCuit($cuit){
        $empresa = Empresa::where('cuit','Like','%'.$cuit.'%')->first();
        if (!is_null($empresa)) {
            $empresa = Empresa::where('cuit','Like','%'.$cuit.'%')->get();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => $empresa,
            );
        }else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    } 


    public function getEmpresaByCode($codigo){
        $empresa = Empresa::where('cuit','Like','%'.$codigo.'%')->first();
        if (!is_null($empresa)) {
            $empresa = Empresa::where('cuit','Like','%'.$codigo.'%')->get();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => $empresa,
            );
        }else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    } 


    public function getEmpresaByBusinessName($razon_social){
        $empresa = Empresa::where('cuit','Like','%'.$razon_social.'%')->first();
        if (!is_null($empresa)) {
            $empresa = Empresa::where('cuit','Like','%'.$razon_social.'%')->get();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'empresa' => $empresa,
            );
        }else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    } 


    public function getUsersByEmpresa($id){
        $empresa = Empresa::find($id);
        if (is_object($empresa)) {
            $users = $empresa->users;
            if (!is_null($users)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'empresa' => $empresa,
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Usuarios no encontrados',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    }


    public function getBancosByEmpresa($id){
        $empresa = Empresa::find($id);    
        if (is_object($empresa)) {
            $bancos = $empresa->bancos;
            if (!is_null($bancos)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'empresa' => $empresa,
                    'bancos' => $$bancos,
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Bancos no encontrados',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    }


    public function getPedidosByEmpresa($id){
        $empresa = Empresa::find($id);
        if (is_object($empresa)) {
            $pedidos = $empresa->pedidos;
            if (!is_null($pedidos)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'empresa' => $empresa,            
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Pedidos no encontrados',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
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
                'message' => 'Empresa no encontrada',
            );
        }
        return response()->json($data);
    }
}
