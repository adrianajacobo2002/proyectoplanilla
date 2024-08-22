<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta de Pago</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 5px;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .header img {
            width: 50px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .header h2 {
            font-size: 18px;
            margin: 0;
            color: #6c757d;
        }

        .title {
            background-color: #e2ece9;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details {
            width: 100%;
            margin-bottom: 20px;
        }

        .details td {
            padding: 5px;
            vertical-align: top;
        }

        .details .label {
            font-weight: bold;
            width: 15%;
        }

        .details .value {
            width: 35%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sistema Universidad</h1>
        </div>

        <table class="details">
            <tr>
                <td class="value">{{ $boleta->mes }}, {{ $boleta->anio }}</td>
        </table>
        <div class="title">BOLETA DE PAGO</div>

        <table class="details">
            
            <tr>
                <td class="label">Empleado:</td>
                <td class="value">{{ $empleado->usuario->nombres }} {{ $empleado->usuario->apellidos }}</td>
                <td class="label">DUI:</td>
                <td class="value">{{ $empleado->DUI }}</td>
            </tr>
            <tr>
                <td class="label">Facultad:</td>
                <td class="value">{{ $empleado->facultad->nombre }}</td>
                <td class="label">Unidad:</td>
                <td class="value">{{ $empleado->unidad->nombre }}</td>
            </tr>
            <tr>
                <td class="label">Cargos:</td>
                <td class="value">
                    <ul>
                        @foreach ($empleado->cargos as $cargo)
                            <li>{{ $cargo->nombre }}</li>
                        @endforeach
                    </ul>

                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Detalle</th>
                    <th>Ingresos</th>
                    <th>Descuentos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Salario Base</td>
                    <td>{{ number_format($empleado->salario, 2) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="1">Salario Proporcional por días laborados</th>
                    <th colspan="2">{{ number_format($boleta->salario_proporcional, 2) }}</th>
                </tr>
                <tr>
                    <td>Bonificaciones Cargos</td>
                    <td>
                        @php
                            $totalBonificaciones = 0;
                        @endphp
                        @foreach ($empleado->cargos as $cargo)
                            {{ $cargo->bonificacion }}<br>
                            @php
                                $totalBonificaciones += $cargo->bonificacion;
                            @endphp
                        @endforeach
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Bono</td>
                    <td>{{ number_format($boleta->bono, 2) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="1">Cantidad Horas Extras</td>
                    <th colspan="2">{{ number_format($boleta->horas_extras) }}</td>
                </tr>
                <tr>
                    <th colspan="1">Total Bonos</th>
                    <th colspan="2">{{ number_format($totalBonificaciones + $boleta->bono, 2) }}</th>
                </tr>
                

                <tr>
                    <td>Cotización del ISSS</td>
                    <td></td>
                    <td>{{ number_format($boleta->isss, 2) }}</td>
                </tr>
                <tr>
                    <td>AFP</td>
                    <td></td>
                    <td>{{ number_format($boleta->afp, 2) }}</td>
                </tr>
                <tr>
                    <td>Descuento de Renta</td>
                    <td></td>
                    <td>{{ number_format($boleta->isr, 2) }}</td>
                </tr>
                <tr>
                    <td>Descuentos Extras</td>
                    <td></td>
                    <td>{{ number_format($boleta->descuentos_extra, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="2">Total Descuentos</th>
                    <th colspan="1">{{ number_format($boleta->isss+ $boleta->afp + $boleta->isr + $boleta->descuentos_extra, 2) }}</th>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p>Total Neto a Pagar: ${{ number_format($boleta->salario_liquido, 2) }}</p>
        </div>
    </div>
</body>

</html>
