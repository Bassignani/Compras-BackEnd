<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    use HasFactory;

    protected $table = 'rubros';

    protected $fillable = [
        'rubro',
        'descripcion',
    ];

    //Relacion muchos a muchos
    public function proveedores() {
        return $this->belongsToMany(Proveedor::class);
    }

    //Relacion uno a muchos
    public function items(){
        return $this->hasMany(Item::class, 'rubro_id');
    }
}
