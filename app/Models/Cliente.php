<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     protected $fillable = [
        'nombre',
        'telefono',
        'empresa',
        'correo',
    ];

    //un cliente puede tener muchas solicitudes

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
