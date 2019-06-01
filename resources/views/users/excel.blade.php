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
        <th style="text-align: center;">NOME</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <td style="text-align: center;">{{ $user->name }}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>
</body>
</html>