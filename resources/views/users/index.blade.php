@extends('adminlte::page')


@section('content')
<div class="container">
    <div class="row">
        <h2>Dizimistas/Ofertantes</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('users.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($users->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $user){
                $linkEdit = route('users.edit', ['user' => $user->id]);
                $linkShow = route('users.show', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $users->links() !!}
</div>

@endsection