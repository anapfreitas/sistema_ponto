<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = ['manage users', 'create posts', 'edit posts', 'delete posts'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'funcionario']);

        $adminRole->givePermissionTo(Permission::all());
        $employeeRole->givePermissionTo(['create posts', 'edit posts']);

        $users = [
            [
                'name' => 'Ana',
                'email' => 'ana@example.com',
                'password' => Hash::make('1234567'),
                'role' => 'admin',
                'role_instance' => $adminRole,
            ],
            [
                'name' => 'Raissa',
                'email' => 'raissa@example.com',
                'password' => Hash::make('1234'),
                'role' => 'funcionario',
                'role_instance' => $employeeRole,
            ]
        ];

        foreach ($users as $userData) {
            $existingUser = User::where('email', $userData['email'])->first();

            if (!$existingUser) {

                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                    'role' => $userData['role'] 
                ]);

                // Atribui o papel ao usuário
                $user->assignRole($userData['role_instance']);
                $this->command->info("Usuário {$userData['email']} criado com sucesso.");
            } else {
                $this->command->info("Usuário {$userData['email']} já existe, pulando...");
            }
        }
    }
}
