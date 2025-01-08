<?php

namespace Tests\Feature;

use App\Models\Ponto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PontoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Loga como funcionário.
     */
    private function loginAsFuncionario()
    {
        $user = User::factory()->create(['role' => 'funcionario']);
        $this->actingAs($user);

        return $user;
    }

    public function test_registro_entrada_valido()
    {
        $user = $this->loginAsFuncionario();

        $response = $this->post(route('pontos.entrada'));

        $response->assertRedirect();
        $this->assertDatabaseHas('pontos', [
            'user_id' => $user->id,
            'data_entrada' => now('America/Sao_Paulo')->toDateString(),
            'hora_entrada' => now('America/Sao_Paulo')->toTimeString(),
        ]);
    }

    public function test_registro_duplicado()
    {
        $user = $this->loginAsFuncionario();

        // Cria um registro de entrada
        Ponto::factory()->create([
            'user_id' => $user->id,
            'data_entrada' => now('America/Sao_Paulo')->toDateString(),
        ]);

        // Tenta registrar a entrada novamente
        $response = $this->post(route('pontos.entrada'));

        $response->assertSessionHasErrors(['message' => 'Entrada já registrada para hoje.']);
        $this->assertCount(1, Ponto::where('user_id', $user->id)->get());
    }

    public function test_visualizacao_historico()
    {
        $user = $this->loginAsFuncionario();

        Ponto::factory()->create([
            'user_id' => $user->id,
            'data_entrada' => now('America/Sao_Paulo')->toDateString(),
            'hora_entrada' => now('America/Sao_Paulo')->toTimeString(),
        ]);

        $response = $this->get(route('pontos.historico'));

        $response->assertStatus(200);
        $response->assertSeeText('Histórico de Pontos');
        $response->assertSeeText(now('America/Sao_Paulo')->toDateString());
    }

    public function test_registro_saida_valido()
    {
        $user = $this->loginAsFuncionario();

        // Cria um registro de entrada
        Ponto::factory()->create([
            'user_id' => $user->id,
            'data_entrada' => now('America/Sao_Paulo')->toDateString(),
            'hora_entrada' => now('America/Sao_Paulo')->toTimeString(),
        ]);

        // Registra a saída
        $response = $this->post(route('pontos.saida'));

        $response->assertRedirect();
        $this->assertDatabaseHas('pontos', [
            'user_id' => $user->id,
            'data_saida' => now('America/Sao_Paulo')->toDateString(),
            'hora_saida' => now('America/Sao_Paulo')->toTimeString(),
        ]);
    }

    public function test_registro_saida_duplicado()
    {
        $user = $this->loginAsFuncionario();

        // Cria um registro de entrada e saída
        Ponto::factory()->create([
            'user_id' => $user->id,
            'data_entrada' => now('America/Sao_Paulo')->toDateString(),
            'hora_entrada' => now('America/Sao_Paulo')->toTimeString(),
            'data_saida' => now('America/Sao_Paulo')->toDateString(),
            'hora_saida' => now('America/Sao_Paulo')->toTimeString(),
        ]);

        // Tenta registrar a saída novamente
        $response = $this->post(route('pontos.saida'));

        $response->assertSessionHasErrors(['message' => 'Saída já registrada para hoje.']);
        $this->assertCount(1, Ponto::where('user_id', $user->id)->get());
    }

    public function test_registro_saida_sem_entrada()
    {
        $user = $this->loginAsFuncionario();

        // Tenta registrar saída sem entrada
        $response = $this->post(route('pontos.saida'));

        $response->assertSessionHasErrors(['message' => 'Nenhuma entrada registrada para hoje.']);
    }
}
