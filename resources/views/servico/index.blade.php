@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Serviços</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('servico.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($servicos->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $servico){
                $linkEdit = route('servico.edit', ['servico' => $servico->id]);
                $linkShow = route('servico.show', ['servico' => $servico->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $servicos->links() !!}
</div>

@endsection