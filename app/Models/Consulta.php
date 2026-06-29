<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'user_id',
        'materia_id',
        'pregunta',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function respuesta()
    {
        return $this->hasOne(RespuestaIa::class, 'consulta_id');
    }

    public function respuestaIa()
    {
        return $this->hasOne(RespuestaIa::class, 'consulta_id');
    }
}