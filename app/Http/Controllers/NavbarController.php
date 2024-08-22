<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NavbarController extends Controller
{
    public function showNavbar()
    {
        $user = Auth::user();
        $initials = strtoupper(substr($user->nombres, 0, 1) . substr($user->apellidos, 0, 1));

        return view('partials.navbar_contador', compact('user', 'initials'));
    }
}
