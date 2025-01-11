@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Cadastrar Novo Usuário</h1>
    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow" style="max-width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label font-semibold" style="color: #0A4F58;">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label font-semibold" style="color: #0A4F58;">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label font-semibold" style="color: #0A4F58;">Papel:</label>
            <select id="role" name="role" class="form-select" style="background-color: #23877A; color: white; border: none;" required>
                <option value="admin" style="color: black;">Admin</option>
                <option value="funcionario" style="color: black;">Funcionário</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label font-semibold" style="color: #0A4F58;">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #0A4F58; color: white; border: none;">Cadastrar</button>
    </form>
</div>
@endsection
