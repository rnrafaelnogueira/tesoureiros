@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Entradas</h3><br>
        {!! Button::primary('Novo')->asLinkTo(route('receita.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($receita->items())->striped()
            ->callback('Ações', function($field, $receita){
            })!!}
    </div>
    {!! $receita->links() !!}
</div>

@endsection



