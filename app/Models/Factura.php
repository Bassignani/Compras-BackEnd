<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'subPedido_id',
        'num_factura',
        'nota',
        'fecha',
        'importe',
        'archivo',
    ];

    //relacion muchos a uno
    public function subPedido(){
        return $this->belongsTo(SubPedido::class, 'subPedido_id');
    }
}
