<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $table = 'cheques';

    protected $fillable = [
        'pago_id',
        'banco',
        'num_cheque',
        'fecha',
        'valor',
    ];

    //relacion muchos a uno
    public function pago(){
        return $this->belongsTo(Pago::class, 'pago_id');
    }
}
