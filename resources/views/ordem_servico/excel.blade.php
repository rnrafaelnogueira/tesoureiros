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
{!! Table::withContents($ordens_servico->items())->striped()->bordered()->condensed()->hover()->withFooter('<tr><td>Total:</td><td>R$ '.$total.',00</td></td>');!!}
</body>
</html>