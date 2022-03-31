<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaBanco;
use Illuminate\Http\Request;


class EmpresaBancoController extends Controller
{
    
    public function index()
    {
        $bancos = EmpresaBanco::all();
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
            'empresa_id' => 'required',
            'banco' => 'required|string|max:255',
            'num_cuenta' => 'string|max:255',
            'cbu' => 'string|max:255',
            'tipo_cuenta' => 'string|max:255',
            'alias' => 'string|max:255',
            'descripcion' => 'string|max:255',
        ]);
        $banco = new EmpresaBanco(); 
        $banco->empresa_id = $request->empresa_id;
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
            'banco' => $banco,
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $banco = EmpresaBanco::find($id);
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

    
    public function update(Request $request,$id)
    {
        $request->validate([
            'empresa_id' => 'required',
            'banco' => 'required|string|max:255',
            'num_cuenta' => 'string|max:255',
            'cbu' => 'string|max:255',
            'tipo_cuenta' => 'string|max:255',
            'alias' => 'string|max:255',
            'descripcion' => 'string|max:255',
        ]);
        $banco = EmpresaBanco::find($id);
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


    public function getBancosByEmpresaID($id){
        $empresa = Empresa::find($id);
        if (!is_null($empresa)) {
            $bancos = EmpresaBanco::where('empresa_id',$id)->first();
            if (!is_null($bancos)) {
                $bancos = EmpresaBanco::where('empresa_id',$id)->get();
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'banco' => $bancos,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Bancos no encontrados'
                ];
            }           
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Empresa no encontrada',
            ];
        }
        return response()->json($data);
    }

    public function getBancoByName($name,$id){
        $banco = EmpresaBanco::where('banco','Like','%'.$name.'%')->where('empresa_id',$id)->first();
        if (!is_null($banco)) {
            $banco = EmpresaBanco::where('banco','Like','%'.$name.'%')->where('empresa_id',$id)->get();
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


    public function getEmpresaByBanco($id){
        $banco = EmpresaBanco::find($id);
        if (is_object($banco)) {
            $empresa = $banco->empresa;
            if (!is_null($empresa)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'banco' => $banco,
                    'empresa' => $empresa,
                ];
            } else {
                $data = [
                  'status' => 'error',
                  'code' => 404,
                  'message' => 'Proveedores no encontrados',   
                ];
            }
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
        $banco = EmpresaBanco::find($id);
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
