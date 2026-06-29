<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🔔 Alertas de Atención</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alerta Confianza Baja -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6 border-l-4 border-red-500">
                <h3 class="text-lg font-bold text-red-700 mb-4">Dificultad con la IA (Confianza < 70%)</h3>
                @foreach($alertasConfianza as $alerta)
                   <p class="mb-2">El estudiante <strong>{{ $alerta['name'] }}</strong> recibe respuestas con solo <strong>{{ round($alerta['promedio'], 2) }}%</strong> de confianza. Podría necesitar una tutoría presencial.</p>
                @endforeach
            </div>

            <!-- Alerta Frecuencia Alta -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                <h3 class="text-lg font-bold text-yellow-700 mb-4">Consultas muy frecuentes (Dudas constantes)</h3>
                @foreach($estudiantesFrecuentes as $frecuente)
                    <p class="mb-2">El estudiante <strong>{{ $frecuente->user->name }}</strong> ha realizado <strong>{{ $frecuente->total }}</strong> consultas esta semana.</p>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>