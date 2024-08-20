<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function contadorDashboard()
    {
        if (auth()->user()->rol !== 'Contador') {
            return redirect()->route('dashboard');
        }
        return view('contador.dashboard');
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