<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = [
        'nombre_materia',
        'descripcion',
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'materia_id');
    }
}
