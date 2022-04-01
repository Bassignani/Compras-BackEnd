<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    public function index()
    {
        $cheques = Cheque::all();
        if (is_object($cheques)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'cheques' => $cheques,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Cheques no encontrados'
            ];
        }
        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'pago_id' => 'required|integer',
            'banco' => 'required|string|max:255',
            'num_cheque' => 'required|string|max:255',
            'fecha' => 'required|date',
            'valor' => 'required|numeric',
        ]);
        $cheque = new Cheque();
        $cheque->pago_id = $request->pago_id;
        $cheque->banco = $request->banco;
        $cheque->num_cheque = $request->num_cheque;
        $cheque->fecha = $request->fecha;
        $cheque->valor = $request->valor;
        $cheque->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'Cheque creada correctamente',
            'cheque' => $cheque, 
        ];
        return response()->json($data);
    }

   
    public function show($id)
    {
        $cheque = Cheque::find($id);
        if (is_object($cheque)) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'cheque' => $cheque,
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Cheque no encontrado',
            ];
        }
        return response()->json($data);
    }

   
    public function update(Request $request,$id)
    {
        $request->validate([
            'pago_id' => 'required|integer',
            'banco' => 'required|string|max:255',
            'num_cheque' => 'required|string|max:255',
            'fecha' => 'required|date',
            'valor' => 'required|numeric',
        ]);
        $cheque = Cheque::find($id);
        if (is_object($cheque)) {
            $cheque = new Cheque();
            $cheque->pago_id = $request->pago_id;
            $cheque->banco = $request->banco;
            $cheque->num_cheque = $request->num_cheque;
            $cheque->fecha = $request->fecha;
            $cheque->valor = $request->valor;
            $cheque->save();
            $data = [
                'status' => 'success',
                'code' => 201,
                'message' => 'Cheque actualizado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Cheque no encontrado',
            ];
        }
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        $cheque = Cheque::find($id);
        if (is_object($cheque)) {
            $cheque->delete();
            $data = [
                'status' => 'success',
                'code' => 200,
                'message' => 'Cheque eliminado correctamente',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Cheque no encontrado',
            ];
        }
        return response()->json($data);
    }

    
    public function getPagoByCheque($id){
        $cheque = Cheque::find($id);    
        if (is_object($cheque)) {
            $pago = $cheque->pago;
            if (!is_null($pago)) {
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'cheque' => $cheque,
                );    
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Pago no encontrado',
                );
            }  
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Cheque no encontrado',
            );
        }
        return response()->json($data);
    }
}
