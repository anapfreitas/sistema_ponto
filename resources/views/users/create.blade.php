@extends('layouts.app')

@section('title', 'Criar Usuário')

@section('content')
<div class="container py-12">
    <h1>Criar Novo Usuário</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Função:</label>
            <select id="role" name="role" class="form-select" required>
                <option value="admin">admin</option>
                <option value="funcionario">funcionario</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
</div>
@endsection