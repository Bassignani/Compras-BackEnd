<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    

    public function index()
    {
        $pagos = Pago::all();
        if (is_object($pagos)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'pagos' => $pagos,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pagos no encontrados'
            ];
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'factura_id' => 'required|integer',
            'tipo' => 'required|string|max:255',
            'valor' => 'numeric',
            'descripcion' => 'string',
        ]);
        $pago = new Pago();
        $pago->factura_id = $request->factura_id;
        $pago->tipo = $request->tipo;
        $pago->valor = $request->valor;
        $pago->descripcion = $request->descripcion;
        $pago->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Pago creada correctamente',
            'pago' => $pago, 
        ];
        return response()->json($data);
    }

   
    public function show($id)
    {
        $pago = Pago::find($id);
        if (is_object($pago)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'pago' => $pago,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'pago no encontrado',
            ];
        }
        return response()->json($data);
    }

   
    public function update(Request $request,$id)
    {
        $request->validate([
            'factura_id' => 'required|integer',
            'tipo' => 'required|string|max:255',
            'valor' => 'numeric',
            'descripcion' => 'string',
        ]);
        $pago = Pago::find($id);
        if (is_object($pago)) {
            $pago->factura_id = $request->factura_id;
            $pago->tipo = $request->tipo;
            $pago->valor = $request->valor;
            $pago->descripcion = $request->descripcion;
            $pago->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Pago actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pago no encontrado',
            ];
        }
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        $pago = Pago::find($id);
        if (is_object($pago)) {
            $pago->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Pago eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Pago no encontrado',
            ];
        }
        return response()->json($data);
    }

    public function getFacturaByPago($id){
        $pago = Pago::find($id);    
        if (is_object($pago)) {
            $factura = $pago->factura;
            if (!is_null($factura)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'pago' => $pago,
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Factura no encontrada',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Pago no encontrado',
            );
        }
        return response()->json($data);
    }


    public function getChequesByPago($id){
        $pago = Pago::find($id);    
        if (is_object($pago)) {
            $cheques = $pago->cheques;
            if (!is_null($cheques)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'pago' => $pago,
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Cheques no encontrados',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Pago no encontrado',
            );
        }
        return response()->json($data);
    }


}
