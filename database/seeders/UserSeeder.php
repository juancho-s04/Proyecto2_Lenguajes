<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $adminRol = Rol::where('nombre', 'ADMINISTRADOR')->first();
        $clienteRol = Rol::where('nombre', 'CLIENTE')->first();

        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'nombre' => 'Administrador',
                'password' => Hash::make('admin123'),
                'rol_id' => $adminRol->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@demo.com'],
            [
                'nombre' => 'Cliente',
                'password' => Hash::make('cliente123'),
                'rol_id' => $clienteRol->id,
            ]
        );
    }
}
