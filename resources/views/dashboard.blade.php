@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12" style="background-color: #E4E5E2; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background-color: #23877A;">
            <div class="p-6 text-white text-lg font-semibold text-center">
                Bem-vindo ao Sistema de Ponto Eletrônico
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card text-white" style="background-color: #0A4F58;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registrar Entrada</h5>
                        <p class="card-text text-center">Registre o início de suas atividades de forma prática.</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success">Registrar Entrada</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white" style="background-color: #0A4F58;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registrar Saída</h5>
                        <p class="card-text text-center">Registre o término de suas atividades.</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger">Registrar Saída</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

