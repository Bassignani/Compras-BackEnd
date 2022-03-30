<?php

namespace App\Http\Controllers;


use App\Models\Rubro;
use Illuminate\Http\Request;


class RubroController extends Controller
{
    
    public function index()
    {
        $rubros = Rubro::all();
        if (is_object($rubros)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'rubros' => $rubros,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'No se han encontrado rubros',
            ];
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'rubro' => 'required|string|max:255',
            'descripcion' => 'string',
        ]);
        $rubro = new Rubro();
        $rubro->rubro = $request->rubro;
        $rubro->descripcion = $request->descripcion;
        $rubro->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Rubro creado correctamente', 
        ];
        return response()->json($data);
    }

    
    public function show($id)
    {
        $rubro = Rubro::find($id);
        if (is_object($rubro)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'rubro' => $rubro,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Rubro no encontrado'
            ];
        }
        return response()->json($data);        
    }

    
    public function update(Request $request,$id)
    {
        $request->validate([
            'rubro' => 'required|string|max:255',
            'descripcion' => 'string',
        ]);
        $rubro = Rubro::find($id);
        if (is_object($rubro)) {
            $rubro->rubro = $request->rubro;
            $rubro->descripcion = $request->descripcion;
            $rubro->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Rubro actualizado correctamente', 
            ];    
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Rubro no encontrado',
            ];
        }
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        $rubro = Rubro::find($id);
        if (is_object($rubro)) {
            $rubro->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Rubro eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Rubro no encontrado'
            ];
        }
        return response()->json($data);
    }


    public function getRubroByname($name){
        $rubro = Rubro::where('rubro','Like','%'.$name.'%')->first();
        if (!is_null($rubro)) {
            $rubros = Rubro::where('rubro','Like','%'.$name.'%')->get();
            $data = [
                'status' => 'success',
                'code' => 200,
                'rubros' => $rubros,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Rubro no encontrado',
            ];
        }
        return response()->json($data);
    }


    public function getProveedoresByRubro($id){
        $rubro = Rubro::find($id);
        if (is_object($rubro)) {
            $proveedores = $rubro->proveedores();
            if (!is_null($proveedores)) {
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'rubro' => $rubro,
                    'proveedores' => $proveedores,
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
                'message' => 'Rubro no encontrado',   
              ];
        }
        return response()->json($data);
    }


}
