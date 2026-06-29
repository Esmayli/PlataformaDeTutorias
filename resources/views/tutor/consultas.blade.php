<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas - Tutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-green-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <h1 class="text-xl font-bold">📊 Consultas de Estudiantes</h1>
                <a href="{{ route('tutor.dashboard') }}" class="bg-green-800 px-4 py-2 rounded">Panel</a>
            </div>
        </nav>

        <div class="max-w-5xl mx-auto mt-8 px-4">
            <h2 class="text-2xl font-bold text-gray-700 mb-6">Todas las consultas</h2>

            @if($consultas->count() === 0)
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500">No hay consultas registradas aún.</p>
                </div>
            @else
                @foreach($consultas as $consulta)
                    <div class="bg-white p-6 rounded-lg shadow mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                    {{ $consulta->materia->nombre_materia }}
                                </span>
                                <span class="text-gray-500 text-sm ml-2">
                                    Estudiante: {{ $consulta->user->name }}
                                </span>
                            </div>
                            <span class="text-gray-400 text-sm">
                                {{ $consulta->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <p class="font-bold text-gray-700">Pregunta:</p>
                            <p class="text-gray-600">{{ $consulta->pregunta }}</p>
                        </div>

                        @if($consulta->respuesta)
                            <div class="bg-gray-50 p-4 rounded border-l-4 border-green-500">
                                <p class="font-bold text-gray-700">Respuesta IA:</p>
                                <p class="text-gray-600">{{ $consulta->respuesta->respuesta }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>