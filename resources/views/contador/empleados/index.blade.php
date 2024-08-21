<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para el ícono del birrete -->
    
    
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="{{asset('images/birre.png')}}" alt="Logo" width="80px" height="60px"> <!-- Icono de Birrete -->
            </a>
            <div class="d-flex">
                <span class="navbar-text">
                    María Gonzáles | Contador/a
                </span>
                <img src="{{asset('images/avatar.webp')}}" alt="Avatar" class="rounded-circle ms-2" width="60" height="60">
            </div>
        </div>
    </nav>

    <!-- Tarjeta principal -->
    <div class="container">
        <div id="main-card" class="card">
            <h3>Empleados</h3>
        </div>
    </div>

    <!-- Tabla de empleados -->
    <div class="container mt-4">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>idEmpleado</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juanito Kevin</td>
                    <td>Cortez Padilla</td>
                    <td>aidonnowhatcanaiput@mail.com</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Juanito Kevin</td>
                    <td>Cortez Padilla</td>
                    <td>aidonnowhatcanaiput@mail.com</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Juanito Kevin</td>
                    <td>Cortez Padilla</td>
                    <td>aidonnowhatcanaiput@mail.com</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
