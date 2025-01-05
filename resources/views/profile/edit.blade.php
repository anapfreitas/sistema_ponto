@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Perfil</h1>
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>

        @if (session('status') === 'profile-updated')
            <p class="mt-2 text-success">Perfil atualizado com sucesso.</p>
        @endif
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
        @csrf
        @method('DELETE')

        <h2 class="text-danger">Deletar Conta</h2>
        <p>Esta ação não pode ser desfeita.</p>

        <div>
            <label for="password" class="form-label">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-danger mt-3">Deletar Conta</button>
    </form>
</div>
@endsection
