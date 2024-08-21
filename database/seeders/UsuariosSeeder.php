<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'empleado_id' => 1,
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('contraseñaSegura1'),
                'rol' => 'Contador',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empleado_id' => 2,
                'nombres' => 'Ana',
                'apellidos' => 'López',
                'email' => 'ana.lopez@example.com',
                'password' => Hash::make('contraseñaSegura2'),
                'rol' => 'Empleado',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empleado_id' => 3,
                'nombres' => 'Jose',
                'apellidos' => 'Regalado',
                'email' => 'jose.regalado@example.com',
                'password' => Hash::make('contraseñaSegura2'),
                'rol' => 'Empleado',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empleado_id' => 4,
                'nombres' => 'Manuel',
                'apellidos' => 'Regalado',
                'email' => 'manuel.regalado@example.com',
                'password' => Hash::make('contraseñaSegura2'),
                'rol' => 'Empleado',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
