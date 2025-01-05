@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="container py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-4 text-lg font-bold text-gray-800" style="color: #0A4F58;">Editar Usuário</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow" style="max-width: 600px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label font-semibold" style="color: #0A4F58;">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label font-semibold" style="color: #0A4F58;">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label font-semibold" style="color: #0A4F58;">Função:</label>
            <select id="role" name="role" class="form-select" style="background-color: #23877A; color: white; border: none;">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="funcionario" {{ $user->role == 'funcionario' ? 'selected' : '' }}>Funcionário</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label font-semibold" style="color: #0A4F58;">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" style="background-color: #23877A; color: white; border: none;">
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #0A4F58; color: white; border: none;">Salvar</button>
    </form>
</div>
@endsection
