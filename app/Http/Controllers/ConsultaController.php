<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Materia;
use App\Models\RespuestaIa;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    public function __construct(protected GeminiService $gemini)
    {
        //
    }

    public function crear()
    {
        $materias = Materia::all();

        return view('estudiante.consulta', compact('materias'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'pregunta' => 'required|string|min:10|max:2000',
        ]);

        $materia = Materia::findOrFail($request->materia_id);

        $consulta = Consulta::create([
            'user_id' => Auth::id(),
            'materia_id' => $request->materia_id,
            'pregunta' => $request->pregunta,
            'estado' => 'procesando',
        ]);

        $respuestaIa = $this->gemini->generarRespuesta(
            $request->pregunta,
            $materia->nombre_materia
        );

        RespuestaIa::create([
            'consulta_id' => $consulta->id,
            'respuesta' => $respuestaIa['respuesta'],
            'nivel_confianza' => $respuestaIa['nivel_confianza'],
        ]);

        $consulta->update([
            'estado' => $respuestaIa['exito'] ? 'respondida' : 'respondida_parcial',
        ]);

        if ($respuestaIa['exito']) {
            return redirect()->route('estudiante.historial')
                ->with('success', '✅ La IA respondió tu consulta correctamente.');
        }

        return redirect()->route('estudiante.historial')
            ->with('warning', '⚠️ La consulta fue guardada, pero hubo un problema al conectar con Gemini.');
    }

    public function historial()
    {
        $consultas = Consulta::with(['materia', 'respuesta'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('estudiante.historial', compact('consultas'));
    }

    public function consultasTutor()
    {
        $consultas = Consulta::with(['user', 'materia', 'respuesta'])
            ->latest()
            ->paginate(15);

        return view('tutor.consultas', compact('consultas'));
    }

    public function todasConsultas()
    {
        return $this->consultasTutor();
    }
}