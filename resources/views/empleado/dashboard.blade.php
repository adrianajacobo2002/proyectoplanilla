<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empleado/a</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS personalizado -->
    <style>
        body {
            background-color: #f5f5f5;
        }

        #main-card {
            background-color: #2f3e55;
            /* Color de fondo similar */
            border-radius: 15px;
            color: white;
            padding: 20px;
        }

        #manage-button {
            background-color: #C1D9D4;
            /* Color del botón */
            border: none;
            color: #2f3e55;
            padding: 10px 20px;
            border-radius: 5px;
        }

        #manage-button:hover {
            background-color: #A9C1B8;
            color: #2f3e55;
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

        .btn-descargar {
            background-color: #C1D9D4;
            border: none;
            color: #2f3e55;
            padding: 5px 15px;
            border-radius: 5px;
        }

        .btn-descargar:hover {
            background-color: #A9C1B8;
            color: #2f3e55;
        }

        /* Estilos para la tabla transparente */
        .table {
            background-color: transparent;
            /* Fondo transparente */
            border-collapse: collapse;
            /* Colapsa los bordes */
        }

        .table th,
        .table td {
            background-color: transparent;
            /* Fondo transparente para las celdas */
            border: none;
            /* Sin bordes */
            color: #2f3e55;
            /* Color del texto */
            padding: 15px;
        }

        /* CSS para hacer que el dropdown sea scrolleable */
        .scrollable-select {
            max-height: 200px;
            /* Establece la altura máxima del dropdown */
            overflow-y: auto;
            /* Activa el scroll vertical */
        }
    </style>
</head>

<body>

    @include('partials.navbar_empleado')

    <!-- Sección principal -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" class="card">
                    <div class="row g-0">
                        <div class="col-md-8 d-flex align-items-center">
                            <div id="main-card-body" class="card-body">
                                <h1 class="card-title">Hola, {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}
                                </h1>
                                <p class="card-text">Ahora es un gran día para verificar tu sueldo :)</p>
                                <a href="{{ route('empleado.perfil') }}" id="manage-button" class="btn">Ver
                                    Perfil</a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/employee.png') }}" class="img-fluid" alt="Empleado"
                                width="400px" height="40px">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para Filtrar -->
        <form action="{{ route('empleado.planillas') }}" method="GET">
            <!-- Sección de filtros -->
            <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <!-- Selector de Mes -->
                    <div class="custom-select-container me-2">
                        <select class="custom-select" id="month" name="mes" aria-label="Seleccione Mes">
                            <option value="">Mes</option>
                            @foreach ($meses as $mes)
                                <option value="{{ $mes }}" {{ request('mes') == $mes ? 'selected' : '' }}>
                                    {{ $mes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selector de Año -->
                    <div class="custom-select-container me-2">
                        <select class="custom-select" id="year" name="anio" aria-label="Seleccione Año">
                            <option value="">Año</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('anio') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón Filtrar -->
                    <button type="submit" class="btn-filtrar"><i class="bi bi-funnel-fill"></i></button>
                </div>
            </div>
        </form>

        <!-- Tabla de sueldos -->
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Año</th>
                            <th>Sueldo Base</th>
                            <th>Ingresos Extra</th>
                            <th>Descuentos</th>
                            <th>Salario Líquido</th>
                            <th>Boleta de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($planillas as $planilla)
                            <tr>
                                <td>{{ $planilla->mes }}</td>
                                <td>{{ $planilla->anio }}</td>
                                <td>${{ number_format($planilla->sueldo_base, 2) }}</td>
                                <td>${{ number_format($planilla->ingresos_extra, 2) }}</td>
                                <td>${{ number_format($planilla->descuentos, 2) }}</td>
                                <td>${{ number_format($planilla->salario_liquido, 2) }}</td>
                                <td><a href=""
                                        class="btn btn-custom">Descargar</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No se encontraron planillas para los filtros seleccionados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
