<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validación de las credenciales
        $credentials = $request->validate([
             'email' => ['required', 'string'],
             'password' => ['required', 'string'],
         ]);
         
        var_dump($credentials);
       
        // Intentar la autenticación usando 'nombre_usuario' y 'password'
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Si la autenticación es exitosa, redirigir según el rol del usuario
            if (Auth::user()->rol == 'Contador') {
                return redirect()->route('contador.dashboard');
            } else {
                return redirect()->route('empleado.dashboard');
            }
        }
    
        // Si la autenticación falla, redirigir de vuelta al formulario de login con un mensaje de error
        return back()->withErrors(['message' => 'Credenciales incorrectas']);
    }
    

    // Maneja el cierre de sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
