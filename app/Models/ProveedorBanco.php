<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorBanco extends Model
{
    use HasFactory;

    protected $table = 'proveedores_bancos';

    protected $fillable = [
        'proveedor_id',
        'banco',
        'num_cuenta',
        'cbu',
        'tipo_cuenta',
        'alias',
        'descripcion',
    ];

    //Relacion muchos a uno
    public function empresa(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

}
