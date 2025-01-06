@extends('layouts.app')

@section('title', 'Registrar Entrada')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-xl font-bold mb-4">Registrar Entrada</h1>
    <form action="{{ route('pontos.entrada') }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded">Registrar Entrada</button>
    </form>
</div>
@endsection
