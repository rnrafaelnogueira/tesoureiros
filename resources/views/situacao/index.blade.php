@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Situações</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('situacao.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($situacoes->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $situacao){
                $linkEdit = route('situacao.edit', ['situacao' => $situacao->id]);
                $linkShow = route('situacao.show', ['situacao' => $situacao->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $situacoes->links() !!}
</div>

@endsection