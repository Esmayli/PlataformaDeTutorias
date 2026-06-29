<?php

namespace App\Http\Controllers;

use App\Models\Tutoria;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutoriaController extends Controller
{
    // ==========================================
    // MÉTODOS PARA EL ESTUDIANTE
    // ==========================================

 public function indexEstudiante()
{
    $tutorias = Tutoria::with(['materia', 'tutor', 'calificacion'])
        ->where('estudiante_id', Auth::id())
        ->orderBy('fecha_hora', 'desc')
        ->get();

    return view('estudiante.tutorias.index', compact('tutorias'));
}

    public function crear()
    {
        $materias = Materia::all();
        return view('estudiante.tutorias.crear', compact('materias'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'materia_id'  => 'required|exists:materias,id',
            'tema'        => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_hora'  => 'required|date|after:now',
        ]);

        Tutoria::create([
            'estudiante_id' => Auth::id(),
            'materia_id'    => $request->materia_id,
            'tema'          => $request->tema,
            'descripcion'   => $request->descripcion,
            'fecha_hora'    => $request->fecha_hora,
            'estado'        => 'pendiente',
        ]);

        return redirect()->route('estudiante.tutorias.index')
            ->with('success', '✅ Solicitud de tutoría enviada correctamente.');
    }

    // ==========================================
    // MÉTODOS PARA EL TUTOR
    // ==========================================

    public function indexTutor()
    {
        $tutorias = Tutoria::with(['materia', 'estudiante'])
            ->orderBy('fecha_hora', 'asc')
            ->get();

        return view('tutor.tutorias.index', compact('tutorias'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $tutoria = Tutoria::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:aceptada,rechazada,completada',
        ]);

        $tutoria->estado = $request->estado;

        // Si el tutor acepta, se asigna como tutor y se genera enlace de videollamada
        if ($request->estado == 'aceptada') {
            $tutoria->tutor_id = Auth::id();

            // Generar enlace automático de Jitsi Meet
            $codigoSala = 'tutoria-ia-' . $tutoria->id . '-' . time();
            $tutoria->enlace_videollamada = 'https://meet.jit.si/' . $codigoSala;
        }

        $tutoria->save();

        $mensajes = [
            'aceptada'   => '✅ Tutoría aceptada. Se generó el enlace de videollamada.',
            'rechazada'  => '❌ Tutoría rechazada.',
            'completada' => '✅ Tutoría marcada como completada.',
        ];

        return back()->with('success', $mensajes[$request->estado]);
    }
}