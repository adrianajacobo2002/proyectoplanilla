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
            background-color: #ffffff; /* Fondo blanco para la barra de navegación */
            border-bottom: 2px solid #e0e0e0; /* Ligeramente gris para separar visualmente */
        }

        #navbar .navbar-text {
            color: #333; /* Color del texto de la barra de navegación */
        }

        #main-card {
            background-color: #56735A; /* Fondo verde de la tarjeta principal */
            border: none;
            color: white; /* Texto blanco dentro de la tarjeta principal */
        }

        #main-card-body {
            color: white; /* Aseguramos que todo el texto en la tarjeta principal sea blanco */
        }

        #manage-button {
            background-color: #ffffff; /* Fondo blanco para el botón */
            border-color: #ffffff;
            color: #323f59; /* Texto verde en el botón */
        }

        #manage-button:hover {
            background-color: #e0e0e0; /* Fondo gris claro al pasar el cursor */
            border-color: #e0e0e0;
            color: #323f59;
        }

        /* Pestañas personalizadas */
        #tabs {
            border-bottom: 1px solid #e0e0e0; /* Línea fina debajo de las pestañas */
        }

        #tabs .nav-link {
            color: #323f59; /* Color de las pestañas no activas */
            border: none;
            padding-bottom: 10px;
            border-radius: 0;
        }

        #tabs .nav-link.active {
            color: #323f59;
            border-bottom: 2px solid; /* Línea de borde inferior para la pestaña activa */
            background-color: transparent; /* Elimina el fondo de la pestaña activa */
        }

        #tabs .nav-link:hover {
            color: #323f59;
        }

        /* Tarjetas de Unidades (solo dentro de las tabs) */
        .tab-content .card {
            background-color: #C1D9D4; /* Fondo gris claro */
            border: none; /* Sin bordes */
            cursor: pointer; /* Hace que el cursor se muestre como un puntero de enlace */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Animación al hacer hover */
        }

        .tab-content .card:hover {
            transform: scale(1.05); /* Escala la tarjeta ligeramente al pasar el cursor */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada al hacer hover */
        }

        /* Elimina subrayado y asegura que toda la tarjeta sea clicable */
        .tab-content .card a {
            text-decoration: none;
            color: inherit;
            text-align: center;
            height: 100%;
        }

        /* Aplica el estilo también al texto dentro del enlace */
        .tab-content .card a h5 {
            text-decoration: none;
        }

        /* También puedes añadir un selector universal para asegurar que ningún texto dentro de la tarjeta tenga subrayado */
        .tab-content .card a * {
            text-decoration: none !important; /* Fuerza la eliminación del subrayado */
        }

        /* Estilos normales para otras tarjetas fuera de las tabs */
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
                    María Gonzáles | Contador/a
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
                            <div id="main-card-body" class="card-body" style="align-items:center">
                                <h1 class="card-title">Hola, María</h1>
                                <p class="card-text">Ahora es un buen día para gestionar los sueldos de nuestros empleados :)</p>
                                <a href="#" id="manage-button" class="btn">Gestionar Planillas</a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/employee.png') }}" class="img-fluid" alt="Contadora">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Unidades y Facultades -->
        <div class="row">
            <div class="col-md-12">
                <ul id="tabs" class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="unidades-tab" data-bs-toggle="tab" data-bs-target="#unidades" type="button" role="tab" aria-controls="unidades" aria-selected="true">Unidades</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="facultades-tab" data-bs-toggle="tab" data-bs-target="#facultades" type="button" role="tab" aria-controls="facultades" aria-selected="false">Facultades</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="unidades" role="tabpanel" aria-labelledby="unidades-tab">
                        <div class="row text-center ">
                            <div id="biblioteca-card " class="col-md-3 mb-3">
                                <a href="#biblioteca" class="card h-100" style="text-decoration: none !important;">
                                    <div class="card-body">
                                        <h5 class="card-title">Biblioteca</h5>
                                    </div>
                                </a>
                            </div>
                            <div id="idiomas-card" class="col-md-3 mb-3">
                                <a href="#idiomas" class="card h-100" style="text-decoration: none !important;">
                                    <div class="card-body">
                                        <h5 class="card-title">Departamento de Idiomas</h5>
                                    </div>
                                </a>
                            </div>
                            <div id="servicios-card" class="col-md-3 mb-3">
                                <a href="#servicios" class="card h-100" style="text-decoration: none !important;">
                                    <div class="card-body">
                                        <h5 class="card-title">Servicios Estudiantiles</h5>
                                    </div>
                                </a>
                            </div>
                            <div id="clinica-card" class="col-md-3 mb-3 align-items-center vh-50">
                                <a href="#clinica" class="card h-100" style="text-decoration: none !important;">
                                    <div class="card-body">
                                        <h5 class="card-title">Clínica Universitaria</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="facultades" role="tabpanel" aria-labelledby="facultades-tab">
                        <!-- Contenido de Facultades -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
