<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Calificaciones</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">

        <nav class="bg-green-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">⭐ Mis Calificaciones</h1>

                <a href="{{ route('tutor.dashboard') }}"
                   class="bg-green-800 hover:bg-green-900 px-4 py-2 rounded transition">
                    ← Volver al Dashboard
                </a>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto mt-8 px-4 pb-10">

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    Resumen de calificaciones
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                        <p class="text-sm text-yellow-700">Promedio</p>
                        <p class="text-3xl font-bold text-yellow-800">
                            {{ $promedio }}/5
                        </p>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <p class="text-sm text-green-700">Total de calificaciones</p>
                        <p class="text-3xl font-bold text-green-800">
                            {{ $calificaciones->count() }}
                        </p>
                    </div>
                </div>
            </div>

            @if($calificaciones->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($calificaciones as $calificacion)
                        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-yellow-400">

                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">
                                        {{ $calificacion->tutoria->tema }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $calificacion->tutoria->materia->nombre_materia ?? 'Sin materia' }}
                                    </p>
                                </div>

                                <span class="text-yellow-500 font-bold">
                                    {{ str_repeat('⭐', $calificacion->puntuacion) }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-2">
                                <strong>Estudiante:</strong> {{ $calificacion->estudiante->name }}
                            </p>

                            <p class="text-sm text-gray-600 mb-2">
                                <strong>Puntuación:</strong> {{ $calificacion->puntuacion }}/5
                            </p>

                            @if($calificacion->comentario)
                                <div class="bg-gray-50 border rounded p-3 mt-3">
                                    <p class="text-sm text-gray-700">
                                        "{{ $calificacion->comentario }}"
                                    </p>
                                </div>
                            @else
                                <p class="text-sm text-gray-400 mt-3">
                                    Sin comentario.
                                </p>
                            @endif

                            <p class="text-xs text-gray-400 mt-4">
                                Fecha de calificación: {{ $calificacion->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-8 text-center">
                    <div class="text-4xl mb-3">⭐</div>
                    <p class="text-gray-500 text-lg">
                        Todavía no tienes calificaciones.
                    </p>
                    <p class="text-gray-400 mt-2">
                        Cuando los estudiantes califiquen tus tutorías, aparecerán aquí.
                    </p>
                </div>
            @endif

        </div>
    </div>
</body>
</html>