<?php

namespace App\Http\Controllers;

use App\Models\ProveedorRubro;
use Illuminate\Http\Request;

class ProveedorRubroController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rubro_id' => 'required|integer',
            'proveedor_id' => 'required|integer',
            
        ]);
        $proveedor_rubro = new ProveedorRubro();
        $proveedor_rubro->rubro_id = $request->rubro_id;
        $proveedor_rubro->proveedor_id = $request->proveedor_id;
        $proveedor_rubro->save();
        $data = [
            'status' => 'success',
            'code' => 201,
            'message' => 'ProveedorRubro creado correctante',
            'proveedor_rubro' => $proveedor_rubro,
        ];
        return response()->json($data);
    }
}
