<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_acesso_negado_para_nao_autenticados()
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect('/login');
    }

    public function test_acesso_negado_para_nao_admins()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('users.index'));
        $response->assertStatus(403);
    }
}
