<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tutorías - Estudiante</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-blue-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">🎓 TutoríaIA - Mis Tutorías</h1>
                <a href="{{ url('/estudiante/dashboard') }}" class="bg-blue-800 hover:bg-blue-900 px-4 py-2 rounded transition">
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

            <!-- Encabezado -->
            <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">📅 Mis Tutorías Agendadas</h2>
                    <p class="text-gray-600">Revisa el estado de tus solicitudes y tutorías programadas.</p>
                </div>
                <a href="{{ route('estudiante.tutorias.crear') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    + Solicitar Nueva Tutoría
                </a>
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

                            <!-- Descripción -->
                            @if($tutoria->descripcion)
                                <p class="text-gray-600 text-sm mb-3">{{ $tutoria->descripcion }}</p>
                            @endif

                            <!-- Fecha -->
                            <p class="text-sm text-gray-500 mb-2">
                                📅 Fecha: {{ \Carbon\Carbon::parse($tutoria->fecha_hora)->format('d/m/Y H:i') }}
                            </p>

                            <!-- Tutor asignado -->
                            @if($tutoria->tutor)
                                <p class="text-sm text-gray-500 mb-4">
                                    👨‍🏫 Tutor: <strong>{{ $tutoria->tutor->name }}</strong>
                                </p>
                            @else
                                <p class="text-sm text-yellow-600 mb-4">
                                    ⏳ Esperando asignación de tutor...
                                </p>
                            @endif

                            <!-- Estado de la tutoría -->
                            @if($tutoria->estado == 'pendiente')
                                <div class="bg-yellow-50 border border-yellow-200 rounded p-3">
                                    <p class="text-sm text-yellow-700">
                                        ⏳ Tu solicitud está pendiente de revisión por un tutor.
                                    </p>
                                </div>

                            @elseif($tutoria->estado == 'aceptada')
                                <div class="bg-green-50 border border-green-200 rounded p-3">
                                    <p class="text-sm text-green-700 font-bold mb-2">
                                        ✅ ¡Tu tutoría fue aceptada!
                                    </p>

                                    @if($tutoria->enlace_videollamada)
                                        <p class="text-sm text-green-600 mb-2">
                                            El enlace de videollamada está listo:
                                        </p>
                                        <a href="{{ $tutoria->enlace_videollamada }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition">
                                            🎥 Unirse a la Videollamada
                                        </a>
                                    @else
                                        <p class="text-sm text-green-600">
                                            El tutor preparará el enlace de videollamada pronto.
                                        </p>
                                    @endif
                                </div>

                           @elseif($tutoria->estado == 'completada')
    <div class="bg-blue-50 border border-blue-200 rounded p-3">
        <p class="text-sm text-blue-700 mb-3">
            📝 Esta tutoría fue completada exitosamente.
        </p>

        @if($tutoria->calificacion)
            <div class="bg-white border rounded p-3">
                <p class="text-sm text-gray-700 font-bold">
                    Ya calificaste esta tutoría
                </p>
                <p class="text-sm text-yellow-600 mt-1">
                    Puntuación: {{ str_repeat('⭐', $tutoria->calificacion->puntuacion) }}
                    ({{ $tutoria->calificacion->puntuacion }}/5)
                </p>

                @if($tutoria->calificacion->comentario)
                    <p class="text-sm text-gray-600 mt-2">
                        "{{ $tutoria->calificacion->comentario }}"
                    </p>
                @endif
            </div>
        @else
            <a href="{{ route('estudiante.calificaciones.crear', $tutoria->id) }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                ⭐ Calificar Tutoría
            </a>
        @endif
    </div>

                            @elseif($tutoria->estado == 'rechazada')
                                <div class="bg-red-50 border border-red-200 rounded p-3">
                                    <p class="text-sm text-red-700">
                                        ❌ Tu solicitud fue rechazada. Intenta solicitar otra tutoría.
                                    </p>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-8 text-center">
                    <div class="text-4xl mb-3">📭</div>
                    <p class="text-gray-500 text-lg">No tienes tutorías agendadas.</p>
                    <p class="text-gray-400 mt-2">¡Solicita tu primera clase!</p>
                    <a href="{{ route('estudiante.tutorias.crear') }}"
                       class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Solicitar Tutoría
                    </a>
                </div>
            @endif

        </div>
    </div>
</body>
</html>