<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
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
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_acesso_negado_para_nao_admins()
    {
        $this->loginAsFuncionario();

        $response = $this->get(route('users.index'));
        $response->assertStatus(403);
    }


    public function test_criacao_de_usuario()
    {
        $admin = $this->loginAsAdmin();

        $data = [
            'name' => 'João Silva',
            'email' => 'joao@hotmail.com',
            'password' => '1234',
            'role' => 'funcionario',
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ]);
    }

    public function test_exibicao_de_detalhes_do_usuario()
    {
        $admin = $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertViewHas('user', $user);
    }


    public function test_exclusao_de_usuario()
    {
        $admin = $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user->id));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
