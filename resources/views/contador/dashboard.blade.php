<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Contador/a</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS personalizado directamente en el archivo Blade -->
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
        }

        #navbar {
            background-color: #ffffff;
            border-bottom: 2px solid #e0e0e0;
        }

        #navbar .navbar-text {
            color: #333;
        }

        #main-card {
            background-color: #56735A;
            border: none;
            color: white;
        }

        #main-card-body {
            color: white;
        }

        #manage-button {
            background-color: #ffffff;
            border-color: #ffffff;
            color: #323f59;
        }

        #manage-button:hover {
            background-color: #e0e0e0;
            border-color: #e0e0e0;
            color: #323f59;
        }

        #tabs {
            border-bottom: 1px solid #e0e0e0;
        }

        #tabs .nav-link {
            color: #323f59;
            border: none;
            padding-bottom: 10px;
            border-radius: 0;
        }

        #tabs .nav-link.active {
            color: #323f59;
            border-bottom: 2px solid;
            background-color: transparent;
        }

        #tabs .nav-link:hover {
            color: #323f59;
        }

        .tab-content .card {
            background-color: #C1D9D4;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
        }

        .tab-content .card-body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .tab-content .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .tab-content .card a {
            text-decoration: none;
            color: inherit;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tab-content .card a h5 {
            text-decoration: none;
            margin: 0;
        }

        .tab-content .card a * {
            text-decoration: none !important;
        }

        .card h5 {
            color: #323f59;
        }

        #main-card-body .card-title {
            color: white;
        }

        #manage-button {
            background-color: #C1D9D4;
            border: none;
            color: #323f59;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación -->
    <nav id="navbar" class="navbar navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="40" height="40">
            </a>
            <div class="d-flex">
                <span class="navbar-text">
                    {{ auth()->user()->name }} | Contador/a
                </span>
                <img src="avatar.png" alt="Avatar" class="rounded-circle ms-2" width="40" height="40">
            </div>
        </div>
    </nav>

    <!-- Sección principal -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" class="card">
                    <div class="row g-0 d-flex align-items-center">
                        <div class="col-md-8">
                            <div id="main-card-body" class="card-body py-4" style="align-items:center">
                                <h1 class="card-title">Hola, {{ auth()->user()->name }}</h1>
                                <p class="card-text">Ahora es un buen día para gestionar los sueldos de nuestros
                                    empleados :)</p>
                                <a href="#" id="manage-button" class="btn">Gestionar Planillas</a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center py-2 px-2">
                            <img src="{{ asset('images/accountant.png') }}" class="img-fluid" alt="Contadora">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Unidades y Facultades -->
        <div class="row my-5">
            <div class="col-md-12">
                <ul id="tabs" class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="unidades-tab" data-bs-toggle="tab"
                            data-bs-target="#unidades" type="button" role="tab" aria-controls="unidades"
                            aria-selected="true">Unidades</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="facultades-tab" data-bs-toggle="tab" data-bs-target="#facultades"
                            type="button" role="tab" aria-controls="facultades"
                            aria-selected="false">Facultades</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <!-- Sección de Unidades -->
                    <div class="tab-pane fade show active my-5" id="unidades" role="tabpanel"
                        aria-labelledby="unidades-tab">
                        <div class="row text-center">
                            @foreach ($unidades as $unidad)
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('unidad.empleados', $unidad->unidad_id) }}" class="card"
                                        style="text-decoration: none !important; height: 100px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $unidad->nombre }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Sección de Facultades -->
                    <div class="tab-pane fade" id="facultades" role="tabpanel" aria-labelledby="facultades-tab">
                        <div class="row text-center">
                            @foreach ($facultades as $facultad)
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('facultad.empleados', $facultad->facultad_id) }}" class="card"
                                        style="text-decoration: none !important; height: 100px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $facultad->nombre }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
