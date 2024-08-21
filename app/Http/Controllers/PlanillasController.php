<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Empleado;

class PlanillasController extends Controller
{
    public function showPlanillas($id)
{
    // Obtener el empleado con sus planillas
    $empleado = Empleado::with('planillas')->findOrFail($id);
    $planillas = $empleado->planillas;

    return view('contador.empleados.planillas', compact('empleado', 'planillas'));
}
}
