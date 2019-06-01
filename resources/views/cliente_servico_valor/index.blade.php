@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Cliente Serviço</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('cliente_servico_valor.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($cliente_servico_valores->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $cliente_servico_valor){
                $linkEdit = route('cliente_servico_valor.edit', ['cliente_servico_valor' => $cliente_servico_valor->id]);
                $linkShow = route('cliente_servico_valor.show', ['cliente_servico_valor' => $cliente_servico_valor->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $cliente_servico_valores->links() !!}
</div>

@endsection