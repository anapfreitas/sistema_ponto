<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use App\Http\Requests\StorePontoRequest;
use Illuminate\Http\Request;

class PontoController extends Controller
{
    public function registrarEntrada(StorePontoRequest $request)
    {
        $user = auth()->user();

        // Verifica se já existe uma entrada para hoje
        $hoje = \Carbon\Carbon::now('America/Sao_Paulo')->toDateString();
        $registro = Ponto::where('user_id', $user->id)
            ->where('data_entrada', $hoje)
            ->first();

        if ($registro) {
            return redirect()->back()->withErrors('Entrada já registrada para hoje.');
        }

        // Cria o registro de entrada
        Ponto::create([
            'user_id' => $user->id,
            'data_entrada' => \Carbon\Carbon::now('America/Sao_Paulo')->toDateString(),
            'hora_entrada' => \Carbon\Carbon::now('America/Sao_Paulo')->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Entrada registrada com sucesso!');
    }

    public function registrarSaida(StorePontoRequest $request)
    {
        $user = auth()->user();

        // Verifica se já existe uma entrada para hoje
        $hoje = \Carbon\Carbon::now('America/Sao_Paulo')->toDateString();
        $registro = Ponto::where('user_id', $user->id)
            ->where('data_entrada', $hoje)
            ->first();

        if (!$registro) {
            return redirect()->back()->withErrors('Nenhuma entrada registrada para hoje.');
        }

        if ($registro->hora_saida) {
            return redirect()->back()->withErrors('Saída já registrada para hoje.');
        }

        // Atualiza o registro com a saída
        $registro->update([
            'data_saida' => \Carbon\Carbon::now('America/Sao_Paulo')->toDateString(),
            'hora_saida' => \Carbon\Carbon::now('America/Sao_Paulo')->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Saída registrada com sucesso!');
    }

    public function historico()
    {
        $user = auth()->user();

        // Busca os registros do usuário
        $registros = Ponto::where('user_id', $user->id)
            ->orderBy('data_entrada', 'desc')
            ->get();

        return view('pontos.historico', compact('registros'));
    }
}
