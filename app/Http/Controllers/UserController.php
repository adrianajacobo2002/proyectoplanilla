<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unidad;
use App\Models\Facultad;

class UserController extends Controller
{
    public function contadorDashboard()
    {
        if (auth()->user()->rol !== 'Contador') {
            return redirect()->route('dashboard');
        }
        //
        $unidades = Unidad::all();
        $facultades = Facultad::all();

        // Pasar las unidades y facultades a la vista del dashboard del contador
        return view('contador.dashboard', compact('unidades', 'facultades'));
    }

    public function empleadoDashboard()
    {
        if (auth()->user()->rol !== 'Empleado') {
            return redirect()->route('dashboard');
        }
        return view('empleado.dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}