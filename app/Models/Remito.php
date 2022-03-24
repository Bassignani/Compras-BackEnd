<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remito extends Model
{
    use HasFactory;

    protected $table = 'remitos';

    protected $fillable = [
        'subPedido_id',
        'num_remito',
        'nota',
        'fecha',
        'archivo',
    ];

    //relacion muchos a uno
    public function subPedido(){
        return $this->belongsTo(SubPedido::class, 'subPedido_id');
    }
}
