<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;
use App\Models\Empleado;
use App\Models\User;

class FacultadesController extends Controller
{
    public function showEmpleados($id)
    {
        // Buscar la facultad usando facultad_id
        $facultad = Facultad::findOrFail($id);

        // Obtener los empleados asociados a esta facultad
        $empleados = Empleado::with('usuario')
            ->where('facultad_id', $id)
            ->get();

        // Retornar la vista con los empleados
        return view('contador.empleados.index', compact('facultad', 'empleados'));
    }
}
