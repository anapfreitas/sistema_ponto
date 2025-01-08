<?php

namespace Database\Factories;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cargo' => $this->faker->jobTitle(),
            'salario' => $this->faker->randomFloat(2, 2000, 10000),
        ];
    }
}