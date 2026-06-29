<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    protected $fillable = [
        'estudiante_id',
        'tutor_id',
        'materia_id',
        'tema',
        'descripcion',
        'fecha_hora',
        'modalidad',
        'enlace_videollamada',
        'estado',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function calificacion()
{
    return $this->hasOne(Calificacion::class);
}
}
