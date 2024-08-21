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
            background-color: #56735A; /* Color de fondo de la tarjeta */
            border-radius: 10px;
            color: white;
            padding: 15px 20px;
            margin-top: 20px;
            border: none;
        }

        .table th, .table td {
            border-top: none; /* Sin bordes superiores */
            border-bottom: 1px solid #ddd; /* Borde inferior ligero */
            color: #2f3e55;
            padding: 12px;
        }

        .table th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .navbar-brand {
            font-weight: bold;
            color: #2f3e55;
        }

        .navbar-text {
            color: #2f3e55;
        }

        .rounded-circle {
            border: 2px solid #56735A;
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/birre.png') }}" alt="Logo" width="80px" height="60px"> <!-- Icono de Birrete -->
            </a>
            <div class="d-flex">
                <span class="navbar-text">
                    {{ auth()->user()->name }} | Contador/a
                </span>
                <img src="{{ asset('images/avatar.webp') }}" alt="Avatar" class="rounded-circle ms-2" width="60" height="60">
            </div>
        </div>
    </nav>

    <!-- Tarjeta principal -->
    <div class="container">
        <div id="main-card" class="card">
            <h3>Empleados de {{ isset($unidad) ? $unidad->nombre : $facultad->nombre }}</h3>
        </div>
    </div>

    <!-- Tabla de empleados -->
    <div class="container mt-4">
        @if($empleados->isEmpty())
            <p>No hay empleados registrados en esta {{ isset($unidad) ? 'unidad' : 'facultad' }}.</p>
        @else
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>ID Empleado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->usuario->nombres ?? 'Sin Asignar' }}</td>
                            <td>{{ $empleado->usuario->apellidos ?? 'Sin Asignar' }}</td>
                            <td>{{ $empleado->usuario->email ?? 'Sin Asignar' }}</td>
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
