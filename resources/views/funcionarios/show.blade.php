@extends('layouts.app')

@section('title', 'Detalhes do Funcionário')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Detalhes do Funcionário</h1>
    <div class="bg-white p-6 rounded-lg shadow" style="max-width: 600px; color: #0A4F58;">
        <p><strong>ID:</strong> {{ $funcionario->id }}</p>
        <p><strong>Nome:</strong> {{ $funcionario->nome }}</p>
        <p><strong>CPF:</strong> {{ $funcionario->cpf }}</p>
        <p><strong>Cargo:</strong> {{ $funcionario->cargo }}</p>
        <p><strong>Salário:</strong> R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</p>
        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary mt-4" style="background-color: #6EC193; color: white; border: none;">Voltar</a>
    </div>
</div>
@endsection