<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificar Tutoría</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">

        <nav class="bg-blue-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">⭐ Calificar Tutoría</h1>
                <a href="{{ route('estudiante.tutorias.index') }}"
                   class="bg-blue-800 hover:bg-blue-900 px-4 py-2 rounded transition">
                    ← Volver
                </a>
            </div>
        </nav>

        <div class="max-w-3xl mx-auto mt-8 px-4 pb-10">

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    {{ $tutoria->tema }}
                </h2>

                <p class="text-gray-600">
                    <strong>Materia:</strong> {{ $tutoria->materia->nombre_materia }}
                </p>

                <p class="text-gray-600">
                    <strong>Tutor:</strong> {{ $tutoria->tutor->name ?? 'Sin tutor' }}
                </p>

                <p class="text-gray-600">
                    <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($tutoria->fecha_hora)->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    Registra tu calificación
                </h3>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc ml-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('estudiante.calificaciones.guardar', $tutoria->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">
                            Puntuación
                        </label>

                        <select name="puntuacion" required
                                class="border rounded w-full py-2 px-3 text-gray-700">
                            <option value="">Selecciona una puntuación</option>
                            <option value="5" {{ old('puntuacion') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Excelente</option>
                            <option value="4" {{ old('puntuacion') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ Muy bueno</option>
                            <option value="3" {{ old('puntuacion') == 3 ? 'selected' : '' }}>⭐⭐⭐ Bueno</option>
                            <option value="2" {{ old('puntuacion') == 2 ? 'selected' : '' }}>⭐⭐ Regular</option>
                            <option value="1" {{ old('puntuacion') == 1 ? 'selected' : '' }}>⭐ Necesita mejorar</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">
                            Comentario
                        </label>

                        <textarea name="comentario" rows="4"
                                  class="border rounded w-full py-2 px-3 text-gray-700"
                                  placeholder="Escribe un comentario sobre la tutoría...">{{ old('comentario') }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                            Guardar Calificación
                        </button>

                        <a href="{{ route('estudiante.tutorias.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>