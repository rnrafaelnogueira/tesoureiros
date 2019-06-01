@extends('adminlte::page')

@section('content')
<div class="container">

    <div class="row">
        

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('paciente.edit',['paciente' => $paciente->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('paciente.destroy',['paciente' => $paciente->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['paciente.destroy' , 'paciente'=> $paciente->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$paciente->id}}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{$paciente->nome}}</td>
            </tr>   
            <tr>
                <th scope="row">Observação</th>
                <td>{{$paciente->observacao}}</td>
            </tr>                     
            </tbody>
        </table>

    </div>
</div>
@endsection

