<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaBanco extends Model
{
    use HasFactory;

    protected $table = 'empresas_bancos';

    protected $fillable = [
        'empresa_id',
        'banco',
        'num_cuenta',
        'cbu',
        'tipo_cuenta',
        'alias',
        'descripcion',
    ];

    //Relacion muchos a uno
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
