<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ponto;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ponto>
 */
class PontoFactory extends Factory
{
    protected $model = Ponto::class;
    public function definition()
    {
        $dataEntrada = $this->faker->dateTimeThisYear();
        $dataSaida = $this->faker->optional()->dateTimeBetween($dataEntrada);
    
        return [
            'user_id' => User::factory(),
            'data_entrada' => $dataEntrada->format('Y-m-d'),
            'hora_entrada' => $dataEntrada->format('H:i:s'),
            'data_saida' => $dataSaida ? $dataSaida->format('Y-m-d') : null,
            'hora_saida' => $dataSaida ? $dataSaida->format('H:i:s') : null,
        ];
    }
    
}