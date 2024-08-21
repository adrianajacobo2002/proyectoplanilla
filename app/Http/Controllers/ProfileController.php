<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Facultad;
use App\Models\Unidad;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Cargo;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user()->load('empleado.unidad', 'empleado.facultad', 'empleado.cargos');

        $initials = strtoupper(substr($user->nombres, 0, 1) . substr($user->apellidos, 0, 1));


        return view('empleado.profile.view', compact('user', 'initials'));
    }
}