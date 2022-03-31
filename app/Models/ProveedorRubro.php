<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorRubro extends Model
{
    use HasFactory;

    protected $table = 'proveedor_rubro';

    protected $fillable = [
        'rubro_id',
        'proveedor_id',
    ];
}
