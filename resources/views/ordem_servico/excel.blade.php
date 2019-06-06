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
{!! Table::withContents($ordens_servico->items())->striped()->bordered()->condensed()->hover()->callback('Ações', function($field, $ordem_servico){
                $linkEdit = route('ordem_servico.edit', ['ordem_servico'=> $ordem_servico->id]);
                $linkShow = route('ordem_servico.show', ['ordem_servico'=> $ordem_servico->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            }) !!}
</body>
</html>