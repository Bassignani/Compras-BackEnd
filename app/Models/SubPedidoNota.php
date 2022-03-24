<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPedidoNota extends Model
{
    use HasFactory;

    protected $table = 'sub_pedido_notas';

    protected $fillable = [
        'subPedido_id',
        'descripcion',
    ];

    //relacion muchos a uno
    public function subPedido(){
        return $this->belongsTo(SubPedido::class, 'subPedido_id');
    }
}
