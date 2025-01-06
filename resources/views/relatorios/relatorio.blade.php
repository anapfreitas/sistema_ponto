@extends('layouts.app')

@section('title', 'Relatório Gerado')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Relatório Gerado</h1>

    <table class="table-auto w-full bg-white rounded-lg shadow-lg">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Funcionário</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Data Entrada</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Hora Entrada</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Data Saída</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Hora Saída</th>
                <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Horas Trabalhadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
            <tr>
                <td class="px-4 py-2">{{ $registro->user->name }}</td>
                <td class="px-4 py-2">{{ $registro->data_entrada }}</td>
                <td class="px-4 py-2">{{ $registro->hora_entrada }}</td>
                <td class="px-4 py-2">{{ $registro->data_saida }}</td>
                <td class="px-4 py-2">{{ $registro->hora_saida }}</td>
                <td class="px-4 py-2">
                    @if($registro->hora_saida && $registro->hora_entrada)
                    {{ $totais[$registro->user_id]['horas'] }}h
                    {{ $totais[$registro->user_id]['minutos'] }}m
                    {{ $totais[$registro->user_id]['segundos'] }}s
                    @else
                    ---
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection