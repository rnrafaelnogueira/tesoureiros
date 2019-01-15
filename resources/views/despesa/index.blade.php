@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Despesas</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('despesas.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($despesas->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $despesa){
                $linkEdit = route('despesas.edit', ['despesa' => $despesa->id]);
                $linkShow = route('despesas.show', ['despesa' => $despesa->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $despesas->links() !!}
</div>

@endsection



