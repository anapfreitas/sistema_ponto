@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<div class="container mx-auto py-12" style="background-color: #E4E5E2;">
    <h1 class="mb-6 text-lg font-bold text-gray-800" style="color: #0A4F58;">Usuários</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-4" style="background-color: #6EC193; color: white; padding: 10px 20px; border-radius: 5px;">Criar Novo Usuário</a>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="bg-[#23877A] text-white text-left">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nome</th>
                    <th class="px-6 py-3">E-mail</th>
                    <th class="px-6 py-3">Função</th>
                    <th class="px-6 py-3">Ações</th>
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
                            <a href="{{ route('users.show', $user->id) }}" class="px-3 py-2 rounded bg-[#6EC193] text-white hover:bg-[#23877A]">Ver</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-2 rounded bg-[#23877A] text-white hover:bg-[#0A4F58]">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 rounded bg-[#FF6B6B] text-white hover:bg-red-700">Excluir</button>
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
