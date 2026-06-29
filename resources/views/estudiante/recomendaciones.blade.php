<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Recomendaciones Académicas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">
                    Hola, {{ $user->name }}
                </h3>

                <p class="text-gray-600">
                    Estas recomendaciones se generan según tu historial de consultas académicas.
                </p>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg text-center">
                        <p class="text-sm text-blue-600">Consultas realizadas</p>
                        <p class="text-3xl font-bold text-blue-800">{{ $totalConsultas }}</p>
                    </div>

                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                        <p class="text-sm text-green-600">Materias consultadas</p>
                        <p class="text-3xl font-bold text-green-800">{{ $resumenMaterias->count() }}</p>
                    </div>

                    <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg text-center">
                        <p class="text-sm text-purple-600">Recomendaciones</p>
                        <p class="text-3xl font-bold text-purple-800">{{ $recomendaciones->count() }}</p>
                    </div>
                </div>
            </div>

            @if($resumenMaterias->count() > 0)
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        📊 Resumen por materia
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Materia</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Consultas</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Confianza promedio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resumenMaterias as $resumen)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-3 text-gray-800 font-medium">
                                            {{ $resumen['materia'] }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-800">
                                            {{ $resumen['total'] }}
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($resumen['promedio_confianza'] !== null)
                                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                                    @if($resumen['promedio_confianza'] >= 80)
                                                        bg-green-100 text-green-700
                                                    @elseif($resumen['promedio_confianza'] >= 60)
                                                        bg-yellow-100 text-yellow-700
                                                    @else
                                                        bg-red-100 text-red-700
                                                    @endif
                                                ">
                                                    {{ $resumen['promedio_confianza'] }}%
                                                </span>
                                            @else
                                                <span class="text-gray-400">Sin datos</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    💡 Recomendaciones personalizadas
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($recomendaciones as $item)
                        <div class="border rounded-lg p-5
                            @if($item['prioridad'] === 'Alta')
                                border-red-200 bg-red-50
                            @elseif($item['prioridad'] === 'Media')
                                border-yellow-200 bg-yellow-50
                            @else
                                border-gray-200 bg-gray-50
                            @endif
                        ">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-bold text-gray-800 text-sm">
                                    {{ $item['titulo'] }}
                                </h4>

                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($item['prioridad'] === 'Alta')
                                        bg-red-200 text-red-800
                                    @elseif($item['prioridad'] === 'Media')
                                        bg-yellow-200 text-yellow-800
                                    @else
                                        bg-gray-200 text-gray-700
                                    @endif
                                ">
                                    {{ $item['prioridad'] }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-3">
                                {{ $item['descripcion'] }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Materia: {{ $item['materia'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/estudiante/consulta') }}"
                   class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
                    Nueva consulta
                </a>

                <a href="{{ url('/estudiante/historial') }}"
                   class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                    Ver historial
                </a>

                <a href="{{ url('/estudiante/dashboard') }}"
                   class="inline-flex items-center bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 px-5 py-2 rounded-lg">
                    Volver al dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>