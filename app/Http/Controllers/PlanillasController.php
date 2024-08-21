<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB; 

class PlanillasController extends Controller
{
    public function showPlanillas($id)
{
    // Obtener el empleado con sus planillas
    $empleado = Empleado::with('planillas')->findOrFail($id);
    $planillas = $empleado->planillas;

    
    $currentYear = date('Y');
    $years = range($currentYear, 2000);

    // Obtener los valores del enum 'mes' desde la base de datos
    $type = DB::select("SHOW COLUMNS FROM planillas WHERE Field = 'mes'")[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $meses = array_map(function($value) {
        return trim($value, "'");
    }, explode(',', $matches[1]));


    return view('contador.empleados.planillas', compact('empleado', 'planillas', 'years', 'meses'));
}
}
