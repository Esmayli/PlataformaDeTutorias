<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Consulta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-blue-600 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <h1 class="text-xl font-bold">🤖 Nueva Consulta</h1>
                <div>
                    <a href="{{ route('estudiante.dashboard') }}" class="bg-blue-800 px-4 py-2 rounded mr-2">Panel</a>
                    <a href="{{ route('estudiante.historial') }}" class="bg-blue-800 px-4 py-2 rounded">Historial</a>
                </div>
            </div>
        </nav>

        <div class="max-w-3xl mx-auto mt-8 px-4">
            <div class="bg-white p-8 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-700 mb-6">Realiza tu consulta académica</h2>

                @if($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('estudiante.consulta.guardar') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Selecciona la materia:</label>
                        <select name="materia_id" class="w-full border border-gray-300 rounded-md p-3">
                            <option value="">-- Selecciona una materia --</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}">{{ $materia->nombre_materia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Escribe tu pregunta:</label>
                        <textarea name="pregunta" rows="5"
                            class="w-full border border-gray-300 rounded-md p-3"
                            placeholder="Escribe tu duda académica aquí...">{{ old('pregunta') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-bold hover:bg-blue-700">
                        Enviar Consulta
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>