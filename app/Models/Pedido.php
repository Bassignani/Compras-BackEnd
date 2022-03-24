<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'empresa_id',
        'user_recepcion_id',
        'fecha_entrega',
        'num_pedido',
        'estado',
        'urgencia',
    ];

    //Relacion uno a muchos
    public function items(){
        return $this->hasMany(Item::class, 'pedido_id');
    }

    public function subPedidos(){
        return $this->hasMany(SubPedido::class, 'pedido_id');
    }

    //Relacion muchos a uno
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function usuarioCreador(){
        return $this->belongsTO(User::class, 'user_id');   
    }

    public function usuarioRecepcion(){
        return $this->belongsTO(User::class, 'user_recepcion_id');   
    }
}
