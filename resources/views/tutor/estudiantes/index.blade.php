<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">👥 Mis Estudiantes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Carrera</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($estudiantes as $estudiante)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $estudiante->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $estudiante->carrera }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $estudiante->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>