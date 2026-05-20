<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
     protected $fillable = [
        'descripcion',
        'nombre_solicitante',
        'correo_solicitante',
        'estado',
        'fecha',
        'user_id',
        'cliente_id',
        'consultoria_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function consultoria()
    {
        return $this->belongsTo(Consultoria::class);
    }
}
