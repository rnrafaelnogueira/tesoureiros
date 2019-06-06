<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
    <meta name="author" content="sfiec">
</head>
<body>
<table>
    <thead>
    <tr>
        <th rowspan="3">Multimídia</th>
        <th>Mês de Junho</th>
        <th></th>
        <th></th>
        <th>data</th>
        <th style="text-align: center;">DESCRIÇÃO</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($saidas as $saida)
        <tr>
            <td style="text-align: left;">{{ $saida->descricao }}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>
</body>
</html>