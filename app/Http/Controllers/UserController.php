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
        

        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        // Obtener los valores del enum 'mes' desde la base de datos
        $type = DB::select("SHOW COLUMNS FROM planillas WHERE Field = 'mes'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $meses = array_map(function($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        return view('empleado.dashboard', compact('years', 'meses'));

        
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