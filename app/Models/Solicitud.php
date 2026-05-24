<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
     protected $table = 'solicitudes';

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

    public function getNombreSolicitanteAttribute(): ?string
    {
        return $this->attributes['nombre_solicitante'] ?? null;
    }

    public function getCorreoSolicitanteAttribute(): ?string
    {
        return $this->attributes['correo_solicitante'] ?? null;
    }

    public function getUsuarioIdAttribute(): ?int
    {
        return $this->attributes['user_id'] ?? null;
    }

    public function getClienteIdAttribute(): ?int
    {
        return $this->attributes['cliente_id'] ?? null;
    }

    public function getConsultoriaIdAttribute(): ?int
    {
        return $this->attributes['consultoria_id'] ?? null;
    }
}
