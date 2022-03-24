<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'empresa_id',
        'name',
        'secondname',
        'lastname',
        'dni',
        'cuil',
        'direccion',
        'telefono',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //Relacion de muchos a uno
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    //Relacion uno a muchos
    public function pedidosCreados(){
        return $this->hasMany(Pedido::class, 'user_id');
    }

    public function pedidosRecibidos(){
        return $this->hasMany(Pedido::class, 'user_recepcion_id');
    }

}
