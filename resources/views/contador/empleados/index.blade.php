<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - {{ isset($unidad) ? $unidad->nombre : $facultad->nombre }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS personalizado -->
    <style>
        body {
            background-color: #f5f5f5;
        }

        #main-card {
            background-color: #56735A;
            border-radius: 10px;
            color: white;
            padding: 15px 20px;
            margin-top: 20px;
            border: none;
        }

        .table th,
        .table td {
            border-top: none;
            border-bottom: 1px solid #ddd;
            color: #2f3e55;
            padding: 12px;
        }

        .table th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .card-header {
            background-color: #56735A;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .back-button {
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #c1d9d4;
            /* Color verde claro */
            border: none;
            color: #2f3e55;
            padding: 10px 20px;
            border-radius: 10px;
            text-align: center;
        }

        .btn-custom:hover {
            background-color: #c1d9d4;
            /* Color al pasar el cursor */
        }
    </style>
</head>

<body>

    @include('partials.navbar_contador')

    <!-- Tarjeta principal -->
    <div class="container">
        <div id="main-card" class="card">
            <h3>Empleados de {{ isset($unidad) ? $unidad->nombre : $facultad->nombre }}</h3>
        </div>
    </div>

    <!-- Tabla de empleados -->
    <div class="container mt-4">
        @if ($empleados->isEmpty())
            <p>No hay empleados registrados en esta {{ isset($unidad) ? 'unidad' : 'facultad' }}.</p>
        @else
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>ID Empleado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Planilla</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->empleado_id }}</td>
                            <td>{{ $empleado->usuario->nombres ?? 'Sin Asignar' }}</td>
                            <td>{{ $empleado->usuario->apellidos ?? 'Sin Asignar' }}</td>
                            <td>{{ $empleado->usuario->email ?? 'Sin Asignar' }}</td>
                            <td><a href="{{ route('contador.empleado.planillas', $empleado->empleado_id) }}" class="btn btn-custom">Ver Planilla</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
