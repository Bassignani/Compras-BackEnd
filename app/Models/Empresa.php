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


//Relación de muchos a uno, muchos post pueden ser creados por el mismo usuario
//   public function user(){
//     return $this->belongsTo('App\User', 'user_id');
//   }

//   //Relación de muchos a uno, muchos post pertenecen a una misma categotia
//   public function category(){
//     return $this->belongsTo('App\Category', 'category_id');
//   }

//Relacion de uno a N, un Cliente puede tener muchos contratos
// public function contratos(){
//     return $this->hasMany(Contrato::class, 'cliente_id');
//   }