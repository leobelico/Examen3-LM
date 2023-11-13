
<html>
<head>
    <style>
        /* Agrega estilos CSS para el PDF según sea necesario */
    </style>
</head>
<body>
    <h1>Listado de Vehículos</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <!-- Agrega más columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->nombre }}</td>
                    <td>{{ $vehiculo->tipo }}</td>
                    <!-- Agrega más celdas según sea necesario -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
