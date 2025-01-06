@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Cadastrar Novo Funcionário</h1>
    <form action="{{ route('funcionarios.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow" style="max-width: 600px;">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label font-semibold" style="color: #0A4F58;">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label font-semibold" style="color: #0A4F58;">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label font-semibold" style="color: #0A4F58;">Cargo:</label>
            <input type="text" id="cargo" name="cargo" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label font-semibold" style="color: #0A4F58;">Salário:</label>
            <input type="number" id="salario" name="salario" step="0.01" class="form-control" style="background-color: #23877A; color: white; border: none;" required>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #0A4F58; color: white; border: none;">Cadastrar</button>
    </form>
</div>
@endsection