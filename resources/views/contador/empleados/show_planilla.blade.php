<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Planilla de {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .main-card {
            background-color: #56735A;
            border-radius: 15px;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-custom1 {
            background-color: #c1d9d4;
            color: #2f3e55;
            padding: 10px 20px;
            border-radius: 5px; 
            display: inline-block;
            margin-bottom: 10px; 
            text-align: center; 
        }

        .form-label {
            color: #2f3e55;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            color: #2f3e55;
        }

        .input-group-text {
            background-color: #9dbfbb;
            color: #2f3e55;
            border: none;
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
            <h3>Detalle Planilla de {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</h3>
        </div>

        <!-- Información del empleado -->
        <div class="section-card">
            <div class="row my-3 mx-3">
                <div class="col-md-12">
                    <h5 class="btn-custom1 mb-4">Información del empleado</h5>
                    <div class="row text-start">
                        <div class="col-md-3 text-end">
                            <p><strong>Empleado:</strong></p>
                            <p><strong>DUI:</strong></p>
                            <p><strong>Tipo de Contrato:</strong></p>
                            <p><strong>Sueldo Base:</strong></p>
                            <p><strong>Sueldo por cargos adicionales:</strong></p>
                        </div>
                        <div class="col-md-9">
                            <p> {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</p>
                            <p>{{ $empleado->DUI }}</p>
                            <p>{{ $empleado->contrato }}</p>
                            <p>${{ number_format($empleado->salario, 2) }}</p>
                            <p>${{ number_format($empleado->cargos->sum('bonificacion')) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de la planilla -->
        <div class="section-card">
            <div class="row my-3 mx-3">
                <div class="col-md-12 mb-4">
                    <h5 class="btn-custom1 mb-4">Información de la planilla</h5>
                    <div class="row px-5">
                        <div class="col-md-6">
                            <label class="form-label">Mes:</label>
                            <p>{{ $planilla->mes }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Año:</label>
                            <p>{{ $planilla->anio }}</p>
                        </div>
                        <hr/>
                        <div class="col-md-6">
                            <label class="form-label">Bono:</label>
                            <p>${{ number_format($planilla->bono, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Días Laborados:</label>
                            <p>{{ $planilla->dias_laborados }}</p>
                        </div>
                        <hr/>
                        <div class="col-md-6">
                            <label class="form-label">Horas Extras:</label>
                            <p>{{ $planilla->horas_extras }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Descuentos Extra:</label>
                            <p>${{ number_format($planilla->descuentos_extra, 2) }}</p>
                        </div>
                        <hr/>
                        <div class="col-md-6">
                            <label class="form-label">Salario Proporcional:</label>
                            <p>${{ number_format($planilla->salario_proporcional, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ISSS:</label>
                            <p>${{ number_format($planilla->isss, 2) }}</p>
                        </div>
                        <hr/>
                        <div class="col-md-6">
                            <label class="form-label">AFP:</label>
                            <p>${{ number_format($planilla->afp, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ISR:</label>
                            <p>${{ number_format($planilla->isr, 2) }}</p>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <label class="form-label">Salario Líquido:</label>
                            <p>${{ number_format($planilla->salario_liquido, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
