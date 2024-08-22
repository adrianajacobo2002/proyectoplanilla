<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Planilla para {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</title>
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

        .btn-custom {
            background-color: #9dbfbb;
            border: none;
            color: #2f3e55;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn-custom:hover {
            background-color: #8fb0aa;
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
            <h3>Crear Planilla para {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</h3>
        </div>

        <!-- Información del empleado -->
        <div class="section-card">
            <h5 class="btn-custom">Información del empleado</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Empleado:</strong> {{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}
                    </p>
                    <p><strong>DUI:</strong> {{ $empleado->DUI }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tipo de Contrato:</strong> {{ $empleado->contrato }}</p>
                    <p><strong>Sueldo Base:</strong> ${{ number_format($empleado->salario, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Información de la planilla -->
        <div class="section-card">
            <h5 class="btn-custom">Información de la planilla</h5>
            <form id="planillaForm" action="{{ route('planillas.store') }}" method="POST">
                @csrf
                <input type="hidden" name="empleado_id" value="{{ $empleado->empleado_id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="mes" class="form-label">Mes:</label>
                        <input type="text" class="form-control" id="mes" name="mes">
                    </div>
                    <div class="col-md-6">
                        <label for="anio" class="form-label">Año:</label>
                        <input type="text" class="form-control" id="anio" name="anio">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="bono" class="form-label">Bono:</label>
                        <input type="number" step="0.01" class="form-control" id="bono" name="bono">
                    </div>
                    <div class="col-md-4">
                        <label for="dias_laborados" class="form-label">Días Laborados:</label>
                        <input type="number" class="form-control" id="dias_laborados" name="dias_laborados">
                    </div>
                    <div class="col-md-4">
                        <label for="horas_extras_am" class="form-label">Horas Extras a.m.:</label>
                        <input type="number" step="0.01" class="form-control" id="horas_extras_am"
                            name="horas_extras_am">
                    </div>
                    <div class="col-md-4">
                        <label for="horas_extras_pm" class="form-label">Horas Extras p.m.:</label>
                        <input type="number" step="0.01" class="form-control" id="horas_extras_pm"
                            name="horas_extras_pm">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="descuentos_extra" class="form-label">Descuentos Extra:</label>
                        <input type="number" step="0.01" class="form-control" id="descuentos_extra"
                            name="descuentos_extra" value="0">
                    </div>
                </div>

                <!-- Botón para calcular -->
                <div class="text-center mb-4">
                    <button type="button" id="calcularButton" class="btn-custom">Calcular</button>
                </div>

                <!-- Descuentos -->
                <div class="section-card">
                    <h5 class="btn-custom">Descuentos</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="isss" class="form-label">ISSS:</label>
                            <input type="text" class="form-control" id="isss" name="isss" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="afp" class="form-label">AFP:</label>
                            <input type="text" class="form-control" id="afp" name="afp" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="isr" class="form-label">ISR:</label>
                            <input type="text" class="form-control" id="isr" name="isr" readonly>
                        </div>
                    </div>
                </div>

                <!-- Salario Líquido -->
                <div class="section-card">
                    <h5 class="btn-custom">Salario Líquido</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" id="salario_liquido" name="salario_liquido"
                            readonly>
                    </div>
                </div>

                <!-- Botón para crear planilla -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn-custom">Crear Planilla</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Lógica para manejar el botón Calcular -->
    <script>
        document.getElementById('calcularButton').addEventListener('click', function() {
            let formData = new FormData(document.getElementById('planillaForm'));

            fetch('{{ route('planillas.calculate') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log para ver la respuesta
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('isss').value = data.isss;
                        document.getElementById('afp').value = data.afp;
                        document.getElementById('isr').value = data.isr;
                        document.getElementById('salario_liquido').value = data.salario_liquido;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
