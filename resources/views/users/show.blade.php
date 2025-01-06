@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
<div class="container py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-4 text-lg font-bold text-gray-800" style="color: #0A4F58;">Detalhes do Usuário</h1>
    <div class="bg-white p-6 rounded-lg shadow" style="max-width: 600px; color: #0A4F58;">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>E-mail:</strong> {{ $user->email }}</p>
        <p><strong>Função:</strong> {{ $user->role }}</p>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-4" style="background-color: #6EC193; color: white; border: none;">Voltar</a>
    </div>
</div>
@endsection