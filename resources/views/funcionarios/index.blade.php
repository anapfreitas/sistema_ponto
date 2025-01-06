@extends('layouts.app')

@section('title', 'Lista de Funcionários')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Funcionários</h1>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="bg-[#23877A] text-white text-left">
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">ID</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Nome</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">CPF</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Cargo</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Salário</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98);">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                <tr class="border-b last:border-none hover:bg-[#6EC193] hover:text-white transition-all">
                    <td class="px-6 py-3">{{ $funcionario->id }}</td>
                    <td class="px-6 py-3">{{ $funcionario->nome }}</td>
                    <td class="px-6 py-3">{{ $funcionario->cpf }}</td>
                    <td class="px-6 py-3">{{ $funcionario->cargo }}</td>
                    <td class="px-6 py-3">R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="px-3 py-2 rounded" style="background-color: #4CAF50; color: white; text-decoration: none;">
                            Editar
                        </a>
                        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este funcionário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 rounded" style="background-color: #FF6B6B; color: white; border: none;">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4" style="color: #0A4F58;">Nenhum funcionário encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection