<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles asegurando que no se dupliquen
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'editor']);

        // Crear usuario admin
        $user = User::firstOrCreate(
            ['email' => 'admin@fundayacucho.gob.ve'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('admin123'), // Contraseña inicial
            ]
        );

        // Asignar el rol de administrador
        $user->assignRole($roleAdmin);

        $this->command->info('Usuario Administrador creado exitosamente.');
        $this->command->info('Credenciales: admin@fundayacucho.gob.ve / admin123');
    }
}
