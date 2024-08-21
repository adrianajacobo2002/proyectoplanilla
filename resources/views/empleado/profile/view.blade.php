<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Empleado</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome para el ícono de cerrar sesión -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS personalizado -->
    <style>
        body {
            background-color: white;
            /* Fondo claro */
        }

        .profile-card {
            background-color: #2f3e55;
            /* Color azul oscuro */
            border-radius: 15px;
            color: white;
            padding: 0px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Centra verticalmente */
        }

        .profile-avatar {
            background-color: #9dbfbb;
            /* Color verde claro */
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 46px;
            color: #2f3e55;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        

        .row.full-height {
            display: flex;
            align-items: center;
            /* Centra verticalmente el contenido */
            height: 100%;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/birre.png') }}" alt="Logo" width="90px" height="60px">
                <!-- Icono de Birrete -->
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center" href="#" id="dropdownAvatar" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('images/avatar.webp') }}" alt="Avatar" class="rounded-circle ms-2"
                            width="50" height="50">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAvatar">
                        <li><a class="dropdown-item" href="#">Cerrar sesión <i
                                    class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sección principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="profile-card justify-content-center">
                    <div class="profile-avatar mt-5">{{ $initials }}</div>
                    <h1 class="pt-2"><b>{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</b></h1>
                    <h5>Empleado</h5>
                </div>
            </div>
            <div class="col-md-6 align-items-center ps-5 ">
                <h5 class="pb-2"><b>Datos Empleado</b></h5>
                <table class="table table-hover table-striped-columns w-100">
                    <tr>
                        <th>Empleado</th>
                        <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                    </tr>
                    <tr>
                        <th>DUI</th>
                        <td>{{ $user->empleado->DUI }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Tipo de Contrato</th>
                        <td>{{ $user->empleado->contrato }}</td>
                    </tr>
                    <tr>
                        <th>Salario Base</th>
                        <td>${{ number_format($user->empleado->salario, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Facultad</th>
                        <td>{{ $user->empleado->facultad?->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Unidad</th>
                        <td>{{ $user->empleado->unidad?->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Cargos</th>
                        <td>
                            <ul>
                                @foreach ($user->empleado->cargos as $cargo)
                                    <li>{{ $cargo->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tabla de Ingresos Extra -->
        <div class="row py-5">
            <div class="text-white py-3 mb-3" style="background-color: #2f3e55; border-radius: 12px;">
                <h5><b>Ingresos Extra</b></h5>
            </div>
            <div class="col-md-12  px-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="w-33">Ingreso Extra</th>
                            <th class="w-33">Tipo</th>
                            <th class="w-33">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->empleado->cargos as $cargo)
                            <tr>
                                <td>{{ $cargo->nombre }}</td>
                                <td>Cargo</td>
                                <td>${{ number_format($cargo->bonificacion, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
