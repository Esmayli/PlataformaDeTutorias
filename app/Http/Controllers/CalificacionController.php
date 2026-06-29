<?php

namespace App\Http\Controllers;

use App\Models\Tutoria;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function crear($tutoria_id)
    {
        $tutoria = Tutoria::with(['materia', 'tutor', 'calificacion'])
            ->where('id', $tutoria_id)
            ->where('estudiante_id', Auth::id())
            ->firstOrFail();

        if ($tutoria->estado !== 'completada') {
            return redirect()->route('estudiante.tutorias.index')
                ->with('error', 'Solo puedes calificar tutorías completadas.');
        }

        if ($tutoria->calificacion) {
            return redirect()->route('estudiante.tutorias.index')
                ->with('error', 'Esta tutoría ya fue calificada.');
        }

        if (!$tutoria->tutor_id) {
            return redirect()->route('estudiante.tutorias.index')
                ->with('error', 'No se puede calificar una tutoría sin tutor asignado.');
        }

        return view('estudiante.calificaciones.crear', compact('tutoria'));
    }

    public function guardar(Request $request, $tutoria_id)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        $tutoria = Tutoria::with('calificacion')
            ->where('id', $tutoria_id)
            ->where('estudiante_id', Auth::id())
            ->firstOrFail();

        if ($tutoria->estado !== 'completada') {
            return redirect()->route('estudiante.tutorias.index')
                ->with('error', 'Solo puedes calificar tutorías completadas.');
        }

        if ($tutoria->calificacion) {
            return redirect()->route('estudiante.tutorias.index')
                ->with('error', 'Esta tutoría ya fue calificada.');
        }

        Calificacion::create([
            'tutoria_id' => $tutoria->id,
            'estudiante_id' => Auth::id(),
            'tutor_id' => $tutoria->tutor_id,
            'puntuacion' => $request->puntuacion,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('estudiante.tutorias.index')
            ->with('success', '✅ Calificación registrada correctamente.');
    }

    public function indexTutor()
    {
        $calificaciones = Calificacion::with(['estudiante', 'tutoria.materia'])
            ->where('tutor_id', Auth::id())
            ->latest()
            ->get();

        $promedio = $calificaciones->count() > 0
            ? round($calificaciones->avg('puntuacion'), 1)
            : 0;

        return view('tutor.calificaciones.index', compact('calificaciones', 'promedio'));
    }
}