<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaIa extends Model
{
    use HasFactory;

    protected $table = 'respuestas_ia';

    protected $fillable = [
        'consulta_id',
        'respuesta',
        'nivel_confianza',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
}