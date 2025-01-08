<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ponto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RelatorioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar os papéis
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'funcionario', 'guard_name' => 'web']);
    }

    private function loginAsAdmin()
    {
        $admin = User::factory()->admin()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);
        return $admin;
    }

    private function loginAsFuncionario()
    {
        $funcionario = User::factory()->funcionario()->create();
        $funcionario->assignRole('funcionario');
        $this->actingAs($funcionario);
        return $funcionario;
    }

    public function test_acesso_negado_para_nao_autenticados()
    {
        $response = $this->get(route('relatorios.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_acesso_negado_para_nao_admin()
    {
        $this->loginAsFuncionario();

        $response = $this->get(route('relatorios.index'));
        $response->assertStatus(403);
    }

    public function test_acesso_admin_a_pagina_de_relatorios()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('relatorios.index'));
        $response->assertStatus(200);
        $response->assertViewIs('relatorios.index');
        $response->assertViewHas('usuarios');
    }

    public function test_geracao_de_relatorio_para_todos_usuarios()
    {
        $this->loginAsAdmin();

        $users = User::factory(3)->funcionario()->create();
        Ponto::factory()->count(3)->create(['user_id' => $users->random()->id]);

        $response = $this->post(route('relatorios.gerar'), [
            'data_inicio' => now()->subDays(7)->format('Y-m-d'),
            'data_fim' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('relatorios.relatorio');
        $response->assertViewHas('registros');
        $response->assertViewHas('totais');
    }

    public function test_geracao_de_relatorio_para_funcionario_especifico()
    {
        $this->loginAsAdmin();

        $users = User::factory(2)->funcionario()->create();
        $specificUser = $users->first();

        Ponto::factory()->count(3)->create(['user_id' => $specificUser->id]);

        $response = $this->post(route('relatorios.gerar'), [
            'funcionario_id' => $specificUser->id,
            'data_inicio' => now()->subDays(7)->format('Y-m-d'),
            'data_fim' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('relatorios.relatorio');
        $response->assertViewHas('registros', function ($registros) use ($specificUser) {
            return $registros->every(fn($registro) => $registro->user_id === $specificUser->id);
        });
    }

    public function test_exportacao_de_relatorio_em_pdf()
    {
        $this->loginAsAdmin();

        $users = User::factory(2)->funcionario()->create();
        Ponto::factory()->count(3)->create(['user_id' => $users->random()->id]);

        $response = $this->post(route('relatorios.gerar'), [
            'data_inicio' => now()->subDays(7)->format('Y-m-d'),
            'data_fim' => now()->format('Y-m-d'),
            'exportar_pdf' => true,
        ]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
