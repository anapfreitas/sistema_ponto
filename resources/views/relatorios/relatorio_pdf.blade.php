<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Relatório de Pontos</h1>
    <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Papel</th>
                <th>Data Entrada</th>
                <th>Hora Entrada</th>
                <th>Data Saída</th>
                <th>Hora Saída</th>
                <th>Horas Trabalhadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
            <tr>
                <td>{{ $registro->user->name }}</td>
                <td>{{ $registro->user->role }}</td>
                <td>{{ $registro->data_entrada }}</td>
                <td>{{ $registro->hora_entrada }}</td>
                <td>{{ $registro->data_saida }}</td>
                <td>{{ $registro->hora_saida }}</td>
                <td>
                    @if($registro->hora_saida && $registro->hora_entrada)
                    {{ $totais[$registro->user_id]['horas'] }}h
                    {{ $totais[$registro->user_id]['minutos'] }}m
                    {{ $totais[$registro->user_id]['segundos'] }}s
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>