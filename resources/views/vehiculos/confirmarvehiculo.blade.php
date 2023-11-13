<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Lista de Vehículos</h3>

                    @if($vehiculos->isEmpty())
    <p>No hay vehículos para mostrar.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Capacidad</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->nombre }}</td>
                    <td>{{ $vehiculo->tipo }}</td>
                    <td>{{ $vehiculo->capacidad }}</td>
                    <td>{{ $vehiculo->color }}</td>
                    <td>{{ $vehiculo->precio }}</td>
                    <td>
                        @if($vehiculo->estado == 1)
                            Disponible
                        @elseif($vehiculo->estado == 2)
                            Pendiente
                        @else
                            Comprado
                        @endif
                    </td>
                    <td>
                        @if($vehiculo->estado == 2) 
                        <form method="POST" action="{{ route('confirmar-vehiculos', $vehiculo->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirmar venta</button>
                    </form>

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

          </div>
            </div>
        </div>
    </div>
</x-app-layout>
