<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; 



Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/contador',[UserController::class, 'contadorDashboard'])->name('contador.dashboard');

    Route::get('/empleado', [UserController::class, 'empleadoDashboard'])->name('empleado.dashboard');
    
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    
    Route::get('/contador/empleados', [UserController::class, 'contadorEmpleadosIndex'])->name('contador.empleados.index');
    
    
});

/* Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
