@extends('layouts.app')

@section('title', 'Exportar Relatório')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Exportar Relatório em PDF</h1>
    <form action="{{ route('relatorios.exportar') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="funcionario_id" class="block text-gray-700">Funcionário:</label>
            <select id="funcionario_id" name="funcionario_id" class="w-full border-gray-300 rounded-lg">
                <option value="">Todos os Funcionários</option>
                @foreach($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}">{{ $funcionario->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="data_inicio" class="block text-gray-700">Data Início:</label>
            <input type="date" id="data_inicio" name="data_inicio" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="data_fim" class="block text-gray-700">Data Fim:</label>
            <input type="date" id="data_fim" name="data_fim" class="w-full border-gray-300 rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Exportar PDF</button>
    </form>
</div>
@endsection