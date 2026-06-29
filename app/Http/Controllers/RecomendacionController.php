<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecomendacionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $consultas = Consulta::with(['materia', 'respuestaIa'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalConsultas = $consultas->count();

        $resumenMaterias = collect();
        $recomendaciones = collect();

        if ($consultas->isNotEmpty()) {
            $resumenMaterias = $consultas->groupBy('materia_id')->map(function ($items) {
                $materia = $items->first()->materia;

                $confianzas = $items->map(function ($consulta) {
                    $valor = optional($consulta->respuestaIa)->nivel_confianza;

                    if ($valor === null) {
                        return null;
                    }

                    return (float) str_replace('%', '', $valor);
                })->filter();

                return [
                    'materia_id' => $materia->id ?? null,
                    'materia' => $materia->nombre_materia ?? 'Sin materia',
                    'total' => $items->count(),
                    'promedio_confianza' => $confianzas->count() > 0
                        ? round($confianzas->avg(), 1)
                        : null,
                ];
            })->sortByDesc('total')->values();

            foreach ($resumenMaterias as $resumen) {
                $materia = $resumen['materia'];
                $total = $resumen['total'];
                $confianza = $resumen['promedio_confianza'];

                if ($confianza !== null && $confianza < 70) {
                    $recomendaciones->push([
                        'tipo' => 'refuerzo',
                        'titulo' => 'Reforzar ' . $materia,
                        'descripcion' => 'Tu nivel de confianza promedio en esta materia es bajo. Te recomendamos repasar conceptos básicos y realizar más ejercicios.',
                        'materia' => $materia,
                        'prioridad' => 'Alta',
                    ]);
                }

                if ($total >= 3) {
                    $recomendaciones->push([
                        'tipo' => 'practica',
                        'titulo' => 'Practicar más ejercicios de ' . $materia,
                        'descripcion' => 'Has realizado varias consultas en esta materia. Para mejorar, resuelve ejercicios prácticos y repasa ejemplos.',
                        'materia' => $materia,
                        'prioridad' => 'Media',
                    ]);
                }

                foreach ($this->sugerenciasPorMateria($materia) as $sugerencia) {
                    $recomendaciones->push($sugerencia);
                }
            }
        }

        if ($recomendaciones->isEmpty()) {
            $recomendaciones = collect([
                [
                    'tipo' => 'general',
                    'titulo' => 'Comienza realizando una consulta',
                    'descripcion' => 'Todavía no tienes suficientes consultas para generar recomendaciones personalizadas. Realiza tu primera pregunta académica.',
                    'materia' => 'General',
                    'prioridad' => 'Media',
                ],
                [
                    'tipo' => 'general',
                    'titulo' => 'Repasa conceptos básicos',
                    'descripcion' => 'Te recomendamos empezar con temas fundamentales como variables, funciones, ecuaciones, velocidad o reacciones químicas.',
                    'materia' => 'General',
                    'prioridad' => 'Baja',
                ],
            ]);
        }

        $recomendaciones = $recomendaciones->unique('titulo')->values();

        return view('estudiante.recomendaciones', compact(
            'user',
            'totalConsultas',
            'resumenMaterias',
            'recomendaciones'
        ));
    }

    private function sugerenciasPorMateria($materia)
    {
        $nombre = Str::lower($materia);

        if (Str::contains($nombre, 'program')) {
            return [
                [
                    'tipo' => 'tema',
                    'titulo' => 'Repasar variables y tipos de datos',
                    'descripcion' => 'Las variables son la base de la programación. Practica declararlas, asignar valores y usar distintos tipos de datos.',
                    'materia' => 'Programación',
                    'prioridad' => 'Media',
                ],
                [
                    'tipo' => 'tema',
                    'titulo' => 'Practicar estructuras condicionales',
                    'descripcion' => 'Domina if, else y switch para tomar decisiones dentro de tus programas.',
                    'materia' => 'Programación',
                    'prioridad' => 'Media',
                ],
                [
                    'tipo' => 'tema',
                    'titulo' => 'Aprender sobre ciclos',
                    'descripcion' => 'Los ciclos for y while son importantes para repetir instrucciones y resolver problemas de lógica.',
                    'materia' => 'Programación',
                    'prioridad' => 'Media',
                ],
            ];
        }

        if (Str::contains($nombre, 'matem')) {
            return [
                [
                    'tipo' => 'tema',
                    'titulo' => 'Repasar ecuaciones y funciones',
                    'descripcion' => 'Practica la resolución de ecuaciones y la interpretación de funciones matemáticas.',
                    'materia' => 'Matemática',
                    'prioridad' => 'Media',
                ],
                [
                    'tipo' => 'tema',
                    'titulo' => 'Estudiar derivadas e integrales',
                    'descripcion' => 'Repasa las reglas básicas de derivación e integración mediante ejercicios prácticos.',
                    'materia' => 'Matemática',
                    'prioridad' => 'Media',
                ],
            ];
        }

        if (Str::contains($nombre, 'fís') || Str::contains($nombre, 'fis')) {
            return [
                [
                    'tipo' => 'tema',
                    'titulo' => 'Practicar velocidad, fuerza y energía',
                    'descripcion' => 'Resuelve ejercicios aplicando fórmulas básicas de movimiento, fuerza y energía.',
                    'materia' => 'Física',
                    'prioridad' => 'Media',
                ],
            ];
        }

        if (Str::contains($nombre, 'quim')) {
            return [
                [
                    'tipo' => 'tema',
                    'titulo' => 'Repasar mol, enlaces y reacciones químicas',
                    'descripcion' => 'Estudia el concepto de mol, los tipos de enlaces químicos y el balanceo de reacciones.',
                    'materia' => 'Química',
                    'prioridad' => 'Media',
                ],
            ];
        }

        return [];
    }
}