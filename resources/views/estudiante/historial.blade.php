<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Consultas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-blue-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <h1 class="text-xl font-bold">📋 Historial de Consultas</h1>
                <div>
                    <a href="{{ route('estudiante.dashboard') }}" class="bg-blue-800 px-4 py-2 rounded mr-2">Panel</a>
                    <a href="{{ route('estudiante.consulta') }}" class="bg-blue-800 px-4 py-2 rounded">Nueva Consulta</a>
                </div>
            </div>
        </nav>

        <div class="max-w-5xl mx-auto mt-8 px-4">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-gray-700 mb-6">Tus consultas anteriores</h2>

            @if($consultas->count() === 0)
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500">No has realizado ninguna consulta aún.</p>
                    <a href="{{ route('estudiante.consulta') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded">
                        Hacer tu primera consulta
                    </a>
                </div>
            @else
                @foreach($consultas as $consulta)
                    <div class="bg-white p-6 rounded-lg shadow mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-bold">
                                {{ $consulta->materia->nombre_materia }}
                            </span>
                            <span class="text-gray-400 text-sm">
                                {{ $consulta->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <p class="font-bold text-gray-700">Tu pregunta:</p>
                            <p class="text-gray-600">{{ $consulta->pregunta }}</p>
                        </div>

                        @if($consulta->respuesta)
                            <div class="bg-gray-50 p-4 rounded border-l-4 border-blue-500">
                                <p class="font-bold text-gray-700">Respuesta:</p>
                                <p class="text-gray-600">{{ $consulta->respuesta->respuesta }}</p>
                                <p class="text-sm text-gray-400 mt-2">
                                    Confianza: {{ $consulta->respuesta->nivel_confianza }}%
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>