<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    /**
     * Nombre de la tabla explícita (evitar pluralización incorrecta)
     */
    protected $table = 'roles';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
