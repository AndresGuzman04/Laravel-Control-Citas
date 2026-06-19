<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'email',
        'estado',
        'numero_documento',
    ];

    // Relación con el modelo Cita
    public function citas() {
        return $this->hasMany(Cita::class);
    }
}
