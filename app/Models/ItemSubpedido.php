<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSubpedido extends Model
{
    use HasFactory;

    protected $table = 'item_sub_pedido';

    protected $fillable = [
        'item_id',
        'subPedido_id',
    ];
}
