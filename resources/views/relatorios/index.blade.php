@extends('layouts.app')

@section('title', 'Gerar Relatórios')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Gerar Relatórios</h1>
    <form action="{{ route('relatorios.gerar') }}" method="POST">
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

        <div class="flex gap-4">
            <button type="submit" name="gerar" class="bg-blue-500 text-white px-4 py-2 rounded">Gerar Relatório</button>
            <button type="submit" name="exportar_pdf" class="bg-green-500 text-white px-4 py-2 rounded">Exportar PDF</button>
        </div>
    </form>
</div>
@endsection