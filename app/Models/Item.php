<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'pedido_id',
        'rubro_id',
        'marca',
        'descripcion',
        'cantidad',
        'precio',
        'estado',
    ];

    //relacion muchos a uno
    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function rubro(){
        return $this->belongsTo(Rublo::class, 'rubro_id');
    }

    //Relacion muchos a muchos
    public function subPedidos() {
        return $this->belongsToMany(SubPedido::class, 'item_sub_pedido');
    }
}
