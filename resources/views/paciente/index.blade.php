@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Pacientes</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('paciente.create')) !!}
    </div>
    <div class="row">
        {!! Table::withContents($pacientes->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $paciente){
                $linkEdit = route('paciente.edit', ['paciente' => $paciente->id]);
                $linkShow = route('paciente.show', ['paciente' => $paciente->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $pacientes->links() !!}
</div>

@endsection