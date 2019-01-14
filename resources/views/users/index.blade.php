@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de membros</h3><br>
        {!! Button::primary('Novo')->asLinkTo(route('users.create')) !!}
        {!! Button::primary('Importar XLS')->asLinkTo(route('importxlsusers')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($users->items())->striped()
            ->callback('Ações', function($field, $user){
                $linkEdit = route('users.edit', ['user' => $user->id]);
                $linkShow = route('users.show', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $users->links() !!}
</div>

@endsection



