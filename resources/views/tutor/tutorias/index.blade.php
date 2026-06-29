<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Tutoría - Tutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-green-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">👨‍🏫 TutoríaIA - Solicitudes de Tutoría</h1>
                <a href="{{ url('/tutor/dashboard') }}" class="bg-green-800 hover:bg-green-900 px-4 py-2 rounded transition">
                    ← Volver al Dashboard
                </a>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto mt-8 px-4 pb-10">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800">📋 Panel de Solicitudes</h2>
                <p class="text-gray-600">Gestiona las solicitudes de tutoría de los estudiantes.</p>
            </div>

            @if($tutorias->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($tutorias as $tutoria)
                        <div class="bg-white shadow rounded-lg p-6 border-l-4
                            @if($tutoria->estado == 'pendiente') border-yellow-500
                            @elseif($tutoria->estado == 'aceptada') border-green-500
                            @elseif($tutoria->estado == 'completada') border-blue-500
                            @else border-red-500 @endif">

                            <!-- Encabezado -->
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $tutoria->tema }}</h3>
                                    <p class="text-sm text-gray-500">{{ $tutoria->materia->nombre_materia }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                    @if($tutoria->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                    @elseif($tutoria->estado == 'aceptada') bg-green-100 text-green-800
                                    @elseif($tutoria->estado == 'completada') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($tutoria->estado) }}
                                </span>
                            </div>

                            <!-- Info del estudiante -->
                            <div class="bg-gray-50 rounded p-3 mb-3">
                                <p class="text-sm text-gray-700">
                                    <strong>Estudiante:</strong> {{ $tutoria->estudiante->name }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    <strong>Carrera:</strong> {{ $tutoria->estudiante->carrera ?? 'No registrada' }}
                                </p>
                            </div>

                            <!-- Descripción -->
                            @if($tutoria->descripcion)
                                <p class="text-gray-600 text-sm mb-3">
                                    <strong>Descripción:</strong> {{ $tutoria->descripcion }}
                                </p>
                            @endif

                            <!-- Fecha -->
                            <p class="text-sm text-gray-500 mb-4">
                                📅 Fecha: {{ \Carbon\Carbon::parse($tutoria->fecha_hora)->format('d/m/Y H:i') }}
                            </p>

                            <!-- Enlace de videollamada (solo si fue aceptada) -->
                            @if($tutoria->estado == 'aceptada' && $tutoria->enlace_videollamada)
                                <div class="bg-green-50 border border-green-200 rounded p-3 mb-4">
                                    <p class="text-sm text-green-700 font-bold mb-2">🎥 Videollamada generada:</p>
                                    <a href="{{ $tutoria->enlace_videollamada }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition">
                                        Unirse a la Videollamada
                                    </a>
                                </div>
                            @endif

                            <!-- Botones de acción -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                @if($tutoria->estado == 'pendiente')
                                    <form method="POST" action="{{ route('tutor.tutorias.estado', $tutoria->id) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="estado" value="aceptada">
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition">
                                            ✅ Aceptar
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('tutor.tutorias.estado', $tutoria->id) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="estado" value="rechazada">
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition">
                                            ❌ Rechazar
                                        </button>
                                    </form>

                                @elseif($tutoria->estado == 'aceptada')
                                    <form method="POST" action="{{ route('tutor.tutorias.estado', $tutoria->id) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="estado" value="completada">
                                        <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                                            📝 Marcar Completada
                                        </button>
                                    </form>

                                @else
                                    <span class="text-gray-400 text-sm">Sin acciones disponibles</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-8 text-center">
                    <div class="text-4xl mb-3">📭</div>
                    <p class="text-gray-500 text-lg">No hay solicitudes de tutoría.</p>
                </div>
            @endif

        </div>
    </div>
</body>
</html>