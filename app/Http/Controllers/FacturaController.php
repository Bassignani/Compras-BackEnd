<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    
    public function index()
    {
        $facturas = Factura::all();
        if (is_object($facturas)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'facturas' => $facturas,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Facturas no encontradas'
            ];
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'subPedido_id' => 'required|integer',
            'num_factura' => 'required|string|max:100',
            'nota' => 'string|max:100',
            'fecha' => 'date',
            'importe' => 'numeric',
            'archivo' => 'required|string|max:100',
        ]);
        $factura = new Factura();
        $factura->subPedido_id = $request->subPedido_id;
        $factura->num_factura = $request->num_factura;
        $factura->nota = $request->nota;
        $factura->fecha = $request->fecha;
        $factura->importe = $request->importe;
        $factura->archivo = $request->archivo;
        $factura->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Factura creada correctamente',
            'factura' => $factura, 
        ];
        return response()->json($data);
    }

   
    public function show($id)
    {
        $factura = Factura::find($id);
        if (is_object($factura)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'factura' => $factura,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Factura no encontrada',
            ];
        }
        return response()->json($data);
    }

   
    public function update(Request $request,$id)
    {
        $request->validate([
            'subPedido_id' => 'required|integer',
            'num_factura' => 'required|string|max:100',
            'nota' => 'string|max:100',
            'fecha' => 'date',
            'importe' => 'numeric',
            'archivo' => 'required|string|max:100',
        ]);
        $factura = Factura::find($id);
        if (is_object($factura)) {
            $factura->subPedido_id = $request->subPedido_id;
            $factura->num_factura = $request->num_factura;
            $factura->nota = $request->nota;
            $factura->fecha = $request->fecha;
            $factura->importe = $request->importe;
            $factura->archivo = $request->archivo;
            $factura->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Factura actualizada correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Factura no encontrada',
            ];
        }
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        $factura = Factura::find($id);
        if (is_object($factura)) {
            $factura->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Factura eliminada correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Factura no encontrada',
            ];
        }
        return response()->json($data);
    }


    public function getSubPedidoByFactura($id){
        $factura = Factura::find($id);
        if (is_object($factura)) {
            $subPedido = $factura->subPedido;
            if(!is_null($subPedido)){
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'factura' => $factura,
                ];
            }else{
                $data = [
                    'status' => 'error',
                    'code' => 4004,
                    'message' => 'SubPedido no encontrado',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 4004,
                'message' => 'Factura no encontrada',
            ];
        }
        return response()->json($data);
    }


}
