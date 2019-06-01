@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Clientes</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('cliente.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($clientes->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $cliente){
                $linkEdit = route('cliente.edit', ['cliente' => $cliente->id]);
                $linkShow = route('cliente.show', ['cliente' => $cliente->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $clientes->links() !!}
</div>

@endsection