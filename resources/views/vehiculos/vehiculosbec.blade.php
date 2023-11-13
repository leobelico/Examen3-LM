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
                                <?php $totalVentas = 0; ?>
                                @foreach($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->nombre }}</td>
                                        <td>{{ $vehiculo->tipo }}</td>
                                        <td>{{ $vehiculo->capacidad }}</td>
                                        <td>{{ $vehiculo->color }}</td>
                                        <td>{{ $vehiculo->precio }}</td>
                                        <td>{{ $vehiculo->estado }}</td>
                                        <td>
                                        <a href="{{ route('vehiculos.subir-imagen', ['id' => $vehiculo->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Subir imagen</a>
                                            
                                        </td>
                                    </tr>

                                    @if($vehiculo->estado == 3)
                                        <?php $totalVentas += $vehiculo->precio; ?>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        @if($totalVentas > 0)
                            <p>Total de ventas: ${{ $totalVentas }}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
