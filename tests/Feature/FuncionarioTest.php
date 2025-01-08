<?php

namespace Tests\Feature;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FuncionarioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

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
        $response = $this->get(route('funcionarios.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_acesso_negado_para_nao_admins()
    {
        $this->loginAsFuncionario();

        $response = $this->get(route('funcionarios.index'));
        $response->assertStatus(403);
    }

    public function test_listagem_de_funcionarios_para_admins()
    {
        $admin = $this->loginAsAdmin();

        $funcionarios = Funcionario::factory(3)->create();

        $response = $this->get(route('funcionarios.index'));

        $response->assertStatus(200);
        $response->assertViewIs('funcionarios.index');
        $response->assertViewHas('funcionarios', function ($viewFuncionarios) use ($funcionarios) {
            return $viewFuncionarios->count() === $funcionarios->count();
        });
    }

    public function test_criacao_de_funcionario()
    {
        $admin = $this->loginAsAdmin();

        $data = [
            'nome' => 'João Silva',
            'cpf' => '12345678901',
            'cargo' => 'Gerente',
            'salario' => 5000.00,
        ];

        $response = $this->post(route('funcionarios.store'), $data);

        $response->assertRedirect(route('funcionarios.index'));
        $this->assertDatabaseHas('funcionarios', $data);
    }

    public function test_exibicao_de_detalhes_do_funcionario()
    {
        $admin = $this->loginAsAdmin();

        $funcionario = Funcionario::factory()->create();

        $response = $this->get(route('funcionarios.show', $funcionario->id));

        $response->assertStatus(200);
        $response->assertViewIs('funcionarios.show');
        $response->assertViewHas('funcionario', $funcionario);
    }

    public function test_edicao_de_funcionario()
    {
        $admin = $this->loginAsAdmin();

        $funcionario = Funcionario::factory()->create();

        $data = [
            'nome' => 'João Silva Editado',
            'cpf' => $funcionario->cpf, 
            'cargo' => 'Supervisor',
            'salario' => 5500.00,
        ];

        $response = $this->put(route('funcionarios.update', $funcionario->id), $data);

        $response->assertRedirect(route('funcionarios.index'));
        $this->assertDatabaseHas('funcionarios', $data);
    }

    public function test_exclusao_de_funcionario()
    {
        $admin = $this->loginAsAdmin();

        $funcionario = Funcionario::factory()->create();

        $response = $this->delete(route('funcionarios.destroy', $funcionario->id));

        $response->assertRedirect(route('funcionarios.index'));
        $this->assertDatabaseMissing('funcionarios', ['id' => $funcionario->id]);
    }
}
