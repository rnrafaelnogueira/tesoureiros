@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Grupos kanban</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('grupo_kanban.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($grupos_kanban->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $grupo_kanban){
                $linkEdit = route('grupo_kanban.edit', ['grupo_kanban' => $grupo_kanban->id]);
                $linkShow = route('grupo_kanban.show', ['grupo_kanban' => $grupo_kanban->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $grupos_kanban->links() !!}
</div>

@endsection