<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\ProfileController;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para mostrar empleados por unidad
Route::get('/contador/unidad/{id}/empleados', [UnidadesController::class, 'showEmpleados'])->name('unidad.empleados');

// Ruta para mostrar empleados por facultad
Route::get('/contador/facultad/{id}/empleados', [FacultadesController::class, 'showEmpleados'])->name('facultad.empleados');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/contador',[UserController::class, 'contadorDashboard'])->name('contador.dashboard');

    Route::get('/empleado', [UserController::class, 'empleadoDashboard'])->name('empleado.dashboard');
    
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/empleado/perfil', [UserController::class, 'perfil'])->name('empleado.perfil');

    Route::get('/empleado/perfil', [ProfileController::class, 'showProfile'])->name('empleado.perfil');

    
});

/* Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
