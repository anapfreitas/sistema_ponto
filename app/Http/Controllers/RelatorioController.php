<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function index()
    {

        $usuarios = User::whereIn('role', ['funcionario', 'admin'])->get();
        return view('relatorios.index', compact('usuarios'));
    }

    public function gerarRelatorio(Request $request)
    {
        $registros = $this->obterRegistros($request);
        $totais = $this->calcularTotais($registros);

        if ($request->has('exportar_pdf')) {
            $pdf = Pdf::loadView('relatorios.relatorio_pdf', compact('registros', 'totais'));
            return $pdf->download('relatorio.pdf');
        }

        return view('relatorios.relatorio', compact('registros', 'totais'));
    }

    private function obterRegistros(Request $request)
    {
        $funcionarioId = $request->input('funcionario_id');
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $query = Ponto::query();

        if ($funcionarioId) {
            $query->where('user_id', $funcionarioId);
        }

        if ($dataInicio && $dataFim) {
            $query->whereBetween('data_entrada', [$dataInicio, $dataFim]);
        }

        $registros = $query->with('user')->orderBy('data_entrada')->get();

        return $registros->map(function ($registro) {
            $registro->data_entrada = \Carbon\Carbon::parse($registro->data_entrada)->format('d/m/Y');
            $registro->data_saida = $registro->data_saida
                ? \Carbon\Carbon::parse($registro->data_saida)->format('d/m/Y')
                : null;
            return $registro;
        });
    }

    private function calcularTotais($registros)
    {
        return $registros->groupBy('user_id')->map(function ($pontos) {
            $totais = $pontos->reduce(function ($total, $ponto) {
                if ($ponto->hora_saida && $ponto->hora_entrada) {
                    $entrada = \Carbon\Carbon::createFromFormat('H:i:s', $ponto->hora_entrada);
                    $saida = \Carbon\Carbon::createFromFormat('H:i:s', $ponto->hora_saida);

                    $total['segundos'] += $entrada->diffInSeconds($saida) % 60;
                    $total['minutos'] += $entrada->diffInMinutes($saida) % 60;
                    $total['horas'] += $entrada->diffInHours($saida);

                    return $total;
                }
                return $total;
            }, ['horas' => 0, 'minutos' => 0, 'segundos' => 0]);


            $totais['minutos'] += intdiv($totais['segundos'], 60);
            $totais['segundos'] %= 60;
            $totais['horas'] += intdiv($totais['minutos'], 60);
            $totais['minutos'] %= 60;

            return $totais;
        });
    }
}
