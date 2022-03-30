<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'cuit',
        'direccion',
        'telefono1',
        'telefono2',
        'razon_social',
        'provincia',
        'localidad',
        'comentario',
        'codigo',
        'email',
        'calificacion',
    ];

    //Relacion muchos a muchos
    public function rubros() {
        return $this->belongsToMany(Rubro::class, 'proveedor:rubro');
    }

    //Relacion uno a muchos
    public function bancos(){
        return $this->hasMany(ProveedorBanco::class, 'proveedor_id');
    }

    public function notas(){
        return $this->hasMany(ProveedorNota::class, 'proveedor_id');
    }

}
