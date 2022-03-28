<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'cuit',
        'razon_social',
        'direccion',
        'telefono1',
        'telefono2',
        'codigo',
        'path_img'
    ];

    //Relacion uno a muchos
    public function users(){
        return $this->hasMany(User::class, 'empresa_id');
    }

    public function bancos(){
        return $this->hasMany(EmpresaBanco::class, 'empresa_id');
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class, 'empresa_id');
    }
}


