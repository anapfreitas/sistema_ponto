@extends('layouts.app')

@section('title', 'Gerar Relatórios')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="text-xl font-bold mb-4" style="color: #0A4F58;">Gerar Relatórios</h1>
    <form action="{{ route('relatorios.gerar') }}" method="POST" class="bg-white p-6 rounded-lg shadow" style="max-width: 600px;">
        @csrf
        <div class="mb-4">
            <label for="funcionario_id" class="block font-semibold mb-2" style="color: #0A4F58;">Usuário:</label>
            <select id="funcionario_id" name="funcionario_id" class="w-full rounded-lg" style="background-color: #23877A; color: white; border: none;">
                <option value="" style="color: black;">Todos os Usuários</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" style="color: black;">{{ $usuario->name }} ({{ $usuario->role }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="data_inicio" class="block font-semibold mb-2" style="color: #0A4F58;">Data Início:</label>
            <input type="date" id="data_inicio" name="data_inicio" class="w-full rounded-lg" style="background-color: #23877A; color: white; border: none;">
        </div>

        <div class="mb-4">
            <label for="data_fim" class="block font-semibold mb-2" style="color: #0A4F58;">Data Fim:</label>
            <input type="date" id="data_fim" name="data_fim" class="w-full rounded-lg" style="background-color: #23877A; color: white; border: none;">
        </div>

        <div class="flex gap-4">
            <button type="submit" name="gerar" class="px-4 py-2 rounded" style="background-color: #23877A; color: white; border: none;">Gerar Relatório</button>
            <button type="submit" name="exportar_pdf" class="px-4 py-2 rounded" style="background-color: #C0392B; color: white; border: none;">Exportar PDF</button>
        </div>
    </form>
</div>
@endsection
