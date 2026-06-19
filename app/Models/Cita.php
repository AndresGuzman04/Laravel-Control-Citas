<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //
    protected $fillable = [
        'paciente_id',
        'user_id',
        'fecha_hora',
        'motivo',
        'estado',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    // Relación con el modelo Paciente
    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con el modelo User
    public function user() {
        return $this->belongsTo(User::class);
    }
}
