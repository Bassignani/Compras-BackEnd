<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorNota extends Model
{
    use HasFactory;

    protected $table = 'proveedores_notas';

    protected $fillable = [
        'proveedor_id',
        'nota',
    ];

    //Relacion muchos a uno
    public function empresa(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
