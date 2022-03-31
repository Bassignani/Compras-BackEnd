<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPedido extends Model
{
    use HasFactory;

    protected $table = 'sub_pedidos';

    protected $fillable = [
        'pedido_id',
        'proveedor_id',
        'fecha_compra',
        'fecha_entrega',
        'total',
    ];

    //Relacion muchos a muchos
    public function items() {
        return $this->belongsToMany(Item::class, 'item_sub_pedido');
    }

    //relacion muchos a uno
    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    //Relacion uno a muchos
    public function facturas(){
        return $this->hasMany(Factura::class, 'subPedido_id');
    }

    public function notas(){
        return $this->hasMany(SubPedidoNota::class, 'subPedido_id');
    }

    public function remitos(){
        return $this->hasMany(Remito::class, 'subPedido_id');
    }
}
