<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Consulta;
use App\Models\Tutoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    public function misEstudiantes()
    {
        // Obtiene estudiantes que han tenido tutorías con este tutor
        $estudiantesIds = Tutoria::where('tutor_id', Auth::id())
            ->pluck('estudiante_id')
            ->unique();

        $estudiantes = User::whereIn('id', $estudiantesIds)->get();

        return view('tutor.estudiantes.index', compact('estudiantes'));
    }

    public function alertas()
    {
        // 1. Alerta: Estudiantes con promedio de confianza IA bajo (menor a 70%)
        // Calculamos en PHP para evitar errores de tipo en PostgreSQL
        $consultas = Consulta::with(['user', 'respuestaIa'])
            ->whereHas('respuestaIa') // Solo las que tienen respuesta
            ->get();

        // Agrupar por usuario y calcular promedio
        $alertasConfianza = $consultas->groupBy('user_id')->map(function ($items) {
            $confianzas = $items->map(function ($consulta) {
                $valor = optional($consulta->respuestaIa)->nivel_confianza;
                // Eliminar % y convertir a número
                return $valor ? (float) str_replace('%', '', $valor) : null;
            })->filter(); // Quitar nulos

            return [
                'name' => $items->first()->user->name,
                'promedio' => $confianzas->count() > 0 ? $confianzas->avg() : 100,
            ];
        })->filter(function ($estudiante) {
            // Solo los que tienen promedio menor a 70
            return $estudiante['promedio'] < 70;
        })->values(); // Resetear índices

        // 2. Alerta: Estudiantes con más de 5 consultas en la última semana
        $estudiantesFrecuentes = Consulta::with('user')
            ->select('user_id', DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('user_id')
            ->having(DB::raw('count(*)'), '>', 5)
            ->get();

        return view('tutor.alertas.index', compact('alertasConfianza', 'estudiantesFrecuentes'));
    }
}