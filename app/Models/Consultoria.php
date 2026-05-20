<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultoria extends Model
{
     protected $fillable = [
        'tipo',
        'descripcion',
    ];

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
