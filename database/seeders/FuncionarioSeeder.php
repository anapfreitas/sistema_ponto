<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funcionarios = [
            [
                'nome' => 'Raissa',
                'cpf' => '12345678',
                'cargo' => 'Secretária',
                'salario' => 4000.00,
            ],
            [
                'nome' => 'Simone',
                'cpf' => '0987654',
                'cargo' => 'Tratorista',
                'salario' => 5000.00,
            ],
        ];

        foreach ($funcionarios as $funcionarioData) {
            Funcionario::create($funcionarioData);
        }

        $this->command->info('Funcionários cadastrados com sucesso!');
    }
}
