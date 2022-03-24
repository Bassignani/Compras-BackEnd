<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'factura_id',
        'tipo',
        'valor',
        'descripcion',
    ];

    //relacion muchos a uno
    public function factura(){
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    //Relacion uno a muchos
    public function cheques(){
        return $this->hasMany(Cheque::class, 'pago_id');
    }
}
