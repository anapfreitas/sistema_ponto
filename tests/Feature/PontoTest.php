<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ponto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PontoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'funcionario', 'guard_name' => 'web']);
    }

    private function loginAsFuncionario()
    {
        $funcionario = User::factory()->funcionario()->create();
        $funcionario->assignRole('funcionario');
        $this->actingAs($funcionario);
        return $funcionario;
    }

    private function loginAsAdmin()
    {
        $admin = User::factory()->admin()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);
        return $admin;
    }

    public function test_acesso_negado_para_nao_autenticados()
    {
        $response = $this->post(route('pontos.entrada'));
        $response->assertRedirect(route('login'));
    }

    public function test_registro_de_entrada()
    {
        $funcionario = $this->loginAsFuncionario();

        $response = $this->post(route('pontos.entrada'));

        $response->assertRedirect();
        $this->assertDatabaseHas('pontos', [
            'user_id' => $funcionario->id,
            'data_entrada' => now()->toDateString(),
            'hora_entrada' => now()->toTimeString(),
        ]);
    }

    public function test_nao_permite_entrada_dupla()
    {
        $funcionario = $this->loginAsFuncionario();

        // Primeira entrada
        $this->post(route('pontos.entrada'));

        // Segunda entrada no mesmo dia
        $response = $this->post(route('pontos.entrada'));

        $response->assertRedirect();
        $response->assertSessionHasErrors(['message' => 'Entrada já registrada para hoje.']);
    }

    public function test_registro_de_saida()
    {
        $funcionario = $this->loginAsFuncionario();

        // Primeiro registra a entrada
        $this->post(route('pontos.entrada'));

        // Em seguida registra a saída
        $response = $this->post(route('pontos.saida'));

        $response->assertRedirect();
        $this->assertDatabaseHas('pontos', [
            'user_id' => $funcionario->id,
            'data_saida' => now()->toDateString(),
            'hora_saida' => now()->toTimeString(),
        ]);
    }

    public function test_nao_permite_saida_sem_entrada()
    {
        $funcionario = $this->loginAsFuncionario();

        $response = $this->post(route('pontos.saida'));

        $response->assertRedirect();
        $response->assertSessionHasErrors(['message' => 'Nenhuma entrada registrada para hoje.']);
    }

    public function test_nao_permite_saida_dupla()
    {
        $funcionario = $this->loginAsFuncionario();

        // Registra entrada e saída
        $this->post(route('pontos.entrada'));
        $this->post(route('pontos.saida'));

        // Tenta registrar saída novamente
        $response = $this->post(route('pontos.saida'));

        $response->assertRedirect();
        $response->assertSessionHasErrors(['message' => 'Saída já registrada para hoje.']);
    }

    public function test_historico_de_pontos()
    {
        $funcionario = $this->loginAsFuncionario();

        // Registra alguns pontos
        Ponto::factory()->count(3)->create(['user_id' => $funcionario->id]);

        $response = $this->get(route('pontos.historico'));

        $response->assertStatus(200);
        $response->assertViewIs('pontos.historico');
        $response->assertViewHas('registros', function ($registros) {
            return $registros->count() === 3;
        });
    }
}
