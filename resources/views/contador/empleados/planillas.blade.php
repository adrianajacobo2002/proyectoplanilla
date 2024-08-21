<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planillas de {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS personalizado -->
    <style>
        body {
            background-color: #f5f5f5;
            /* Fondo claro */
        }

        .main-card {
            background-color: #56735A;
            /* Color verde oscuro */
            border-radius: 15px;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        .dropdown-toggle {
            background-color: #9dbfbb;
            /* Color verde claro */
            border: none;
            color: #2f3e55;
            padding: 8px 16px;
            border-radius: 10px;
        }

        .dropdown-toggle:hover,
        .btn:hover {
            background-color: #8fb0aa;
            /* Color al pasar el cursor */
            color: #2f3e55;
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
            background-color: #8fb0aa;
            /* Color al pasar el cursor */
        }

        .table th,
        .table td {
            color: #2f3e55;
            padding: 12px;
            vertical-align: middle;
        }

        .table th {
            font-weight: bold;
        }

        .table .btn {
            background-color: #c1d9d4;
            /* Color verde claro */
            border: none;
            color: #2f3e55;
            padding: 5px 15px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    @include('partials.navbar_contador')

    <!-- Sección principal -->
    <div class="container mt-4">
        <!-- Tarjeta principal -->
        <div class="main-card">
            <h3>Planillas de {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</h3>
        </div>

        <!-- Filtros y botón -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn-custom">Crear Planilla</button>
            <div class="d-flex align-items-center">
                <div class="dropdown me-2">
                    <button class="dropdown-toggle" type="button" id="dropdownYear" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Año
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownYear">
                        <li><a class="dropdown-item" href="#">2024</a></li>
                        <li><a class="dropdown-item" href="#">2023</a></li>
                        <li><a class="dropdown-item" href="#">2022</a></li>
                    </ul>
                </div>
                <div class="dropdown me-2">
                    <button class="dropdown-toggle" type="button" id="dropdownMonth" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Mes
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMonth">
                        <li><a class="dropdown-item" href="#">Agosto</a></li>
                        <li><a class="dropdown-item" href="#">Julio</a></li>
                        <li><a class="dropdown-item" href="#">Junio</a></li>
                    </ul>
                </div>
                <button class="dropdown-toggle" type="button" id="dropdownSettings">
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
        </div>

        <!-- Tabla de planillas -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Año</th>
                        <th>Sueldo Base</th>
                        <th>Ingresos Extra</th>
                        <th>Descuentos</th>
                        <th>Días laborados</th>
                        <th>Salario Líquido</th>
                        <th>Detalle Planilla</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planillas as $planilla)
                        <tr>
                            <td>{{ $planilla->mes }}</td>
                            <td>{{ $planilla->anio }}</td>
                            <td>${{ number_format($empleado->salario, 2) }}</td>
                            <!-- Sueldo base se extrae de empleados -->
                            <td>${{ number_format($planilla->ingresos_extra, 2) }}</td>
                            <td>${{ number_format($planilla->descuentos_extra, 2) }}</td>
                            <td>{{ $planilla->dias_laborados }}</td>
                            <td>${{ number_format($planilla->salario_liquido, 2) }}</td>
                            <td>
                                <a href="#" class="btn btn-primary">Detalle de Planilla</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
