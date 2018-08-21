@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de membros</h3><br>
        {!! Button::primary('Novo')->asLinkTo(route('users.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($users->items())->striped()
            ->callback('Ações', function($field, $user){
            })!!}
    </div>
    {!! $users->links() !!}
</div>

@endsection



