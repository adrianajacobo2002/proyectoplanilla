<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

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

        // Obtener al usuario autenticado
        $usuario = auth()->user();

        // Obtener al empleado asociado al usuario
        $empleado = $usuario->empleado;

        // Obtener las planillas del empleado
        $planillas = $empleado->planillas;

        // Obtener los valores del enum 'mes' desde la base de datos
        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        $type = DB::select("SHOW COLUMNS FROM planillas WHERE Field = 'mes'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $meses = array_map(function($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        // Pasar las variables a la vista
        return view('empleado.dashboard', compact('empleado', 'planillas', 'years', 'meses'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function perfil()
    {
        return view('empleado.profile.view');
    }

}