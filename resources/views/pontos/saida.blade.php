@extends('layouts.app')

@section('title', 'Registrar Saída')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Registrar Saída</h1>
    <form action="{{ route('pontos.saida') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded">Registrar Saída</button>
    </form>
</div>
@endsection
