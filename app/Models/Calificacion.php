<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';

    protected $fillable = [
        'tutoria_id',
        'estudiante_id',
        'tutor_id',
        'puntuacion',
        'comentario',
    ];

    public function tutoria()
    {
        return $this->belongsTo(Tutoria::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}