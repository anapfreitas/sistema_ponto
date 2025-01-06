@extends('layouts.app')

@section('title', 'Histórico de Pontos')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Histórico de Pontos</h1>
    <table class="table-auto w-full bg-white rounded-lg shadow-lg">
        <thead>
            <tr class="bg-[#23877A] text-white">
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Data de Entrada</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Hora de Entrada</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Data de Saída</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Hora de Saída</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registros as $registro)
                <tr class="border-b last:border-none hover:bg-[#6EC193] transition-all">
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($registro->data_entrada)->format('d/m/Y') ?? '---' }}</td>
                    <td class="px-4 py-2">{{ $registro->hora_entrada ?? '---' }}</td>
                    <td class="px-4 py-2">{{ $registro->data_saida ? \Carbon\Carbon::parse($registro->data_saida)->format('d/m/Y') : '---' }}</td>
                    <td class="px-4 py-2">{{ $registro->hora_saida ?? '---' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Nenhum registro encontrado.</td>
                </tr>
            @endforelse
        </tbody>
</div>
@endsection
