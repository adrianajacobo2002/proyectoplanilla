<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planillas de {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS personalizado -->
    <style>
        body {
            background-color: white;
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

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #cde2dd;
            /* Color de fondo */
            border: none;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 16px;
            color: #2b3a42;
            width: 150px;
            /* Ajustar el ancho para que ambos select sean del mismo tamaño */
            max-width: 150px;
            text-align: left;
            cursor: pointer;
            position: relative;
            display: inline-block;
        }

        /* Fondo blanco cuando se expande */
        .custom-select option {
            background-color: #ffffff;
            /* Fondo blanco para las opciones */
            color: #2b3a42;
            /* Color de texto */
        }

        /* Asegurar que el dropdown sea scrolleable */
        .custom-select-container {
            max-height: 200px;
            /* Altura máxima para el scroll */
            overflow-y: auto;
            /* Activar scroll vertical */
        }

        /* Añadir un icono de dropdown */
        .custom-select::after {
            content: '\25BC';
            /* Código para el ícono de la flecha */
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #2b3a42;
        }

        /* Remover estilo del borde y sombras al hacer focus */
        .custom-select:focus {
            outline: none;
            box-shadow: none;
        }
        
        .scrollable-select {
            max-height: 200px;
            /* Establece la altura máxima del dropdown */
            overflow-y: auto;
            /* Activa el scroll vertical */
        }
        .btn:hover {
            background-color: #8fb0aa;
            /* Color al pasar el cursor */
            color: #2f3e55;
        }
        .btn-filtrar {
            background-color: #C1D9D4;
            border: none;
            color: #2f3e55;
            padding: 5px 15px;
            border-radius: 5px;
        }

        .btn-filtrar:hover {
            background-color: #A9C1B8;
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
                
                <!-- Selector de Mes -->
                <div class="custom-select-container me-2">
                    <select class="custom-select" id="month" name="month" aria-label="Seleccione Mes">
                        <option value="">Mes</option>
                        @foreach ($meses as $mes)
                            <option value="{{ $mes }}" {{ request('month') == $mes ? 'selected' : '' }}>
                                {{ $mes }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Selector de Año -->
                <div class="custom-select-container me-2">
                    <select class="custom-select" id="year" name="year" aria-label="Seleccione Año">
                        <option value="">Año</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn-filtrar"><i class="bi bi-funnel-fill"></i></button>
            </div>
        </div>

        <!-- Tabla de planillas -->
        <div class="table-responsive pt-4">
            <table class="table table-hover table-striped">
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
