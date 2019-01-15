@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h3>Receita</h3><br>
        {!! Button::primary('Novo')->asLinkTo(route('receitas.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($receitas->items())->striped()
            ->callback('Ações', function($field, $receita){
                $linkEdit = route('receitas.edit', ['receita' => $receita->id]);
                $linkShow = route('receitas.show', ['receita' => $receita->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $receitas->links() !!}
</div>

@endsection



