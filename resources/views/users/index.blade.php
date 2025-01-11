@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Usuários</h1>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="bg-[#23877A] text-white text-left">
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">ID</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Nome</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">E-mail</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Função</th>
                    <th class="px-3 py-2 rounded" style="background-color:rgb(29, 141, 98)">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="border-b last:border-none hover:bg-[#6EC193] hover:text-white transition-all">
                    <td class="px-6 py-3">{{ $user->id }}</td>
                    <td class="px-6 py-3">{{ $user->name }}</td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">{{ $user->role }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
                    <td colspan="5" class="text-center py-4" style="color: #0A4F58;">Nenhum usuário encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection