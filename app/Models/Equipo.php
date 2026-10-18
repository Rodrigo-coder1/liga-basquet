<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $fillable = [
        'nombre',
        'ciudad',
        'entrenador',
    ];

    public function jugadores(): HasMany
    {
        return $this->hasMany(Jugador::class);
    }
}