<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BECARIO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('importar-vehiculos') }}" class="text-blue-500 hover:underline">Importar Vehículos</a><p><p><p>
                <a href="{{ route('confirmar-vehiculo') }}" class="text-blue-500 hover:underline">Ver Vehículos pendientes</a><p><p>
                <a href="{{ route('vehiculos-bec') }}" class="text-blue-500 hover:underline">Subir Imagen </a><p><p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
