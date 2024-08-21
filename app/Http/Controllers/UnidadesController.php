<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\Empleado;
use App\Models\User;

class UnidadesController extends Controller
{
    public function showEmpleados($id)
{
    // Buscar la unidad usando unidad_id
    $unidad = Unidad::findOrFail($id);

    // Obtener los empleados asociados a esta unidad
    $empleados = Empleado::with('usuario')
        ->where('unidad_id', $id)
        ->get();

    return view('contador.empleados.index', compact('unidad', 'empleados'));
}

}
