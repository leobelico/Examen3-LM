
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subir Imagen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Subir Imagen</h3>

                    <form action="{{ route('vehiculos.agregar', ['id' => $vehiculo->id]) }}" method="post" enctype="multipart/form-data">
    @csrf

    <input type="file" name="imagen_3d" onchange="previewImage(this)">
    <img id="preview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;">
    <button type="submit">Subir Imagen</button>
</form>

                    <script>
                        function previewImage(input) {
                            var preview = document.getElementById('preview');
                            preview.style.display = 'block';

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                preview.src = e.target.result;
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
