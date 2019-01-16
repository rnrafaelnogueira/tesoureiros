@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Tipos de Pagamento</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('categorias.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($categorias->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $categoria){
                $linkEdit = route('categorias.edit', ['categoria' => $categoria->id]);
                $linkShow = route('categorias.show', ['categoria' => $categoria->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $categorias->links() !!}
</div>

@endsection