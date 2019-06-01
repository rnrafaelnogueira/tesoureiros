@extends('adminlte::page')

@section('content')
<div class="container">

    <div class="row">
        

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('servico.edit',['servico' => $servico->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('servico.destroy',['servico' => $servico->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['servico.destroy' , 'servico'=> $servico->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$servico->id}}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{$servico->nome}}</td>
            </tr>                   
            </tbody>
        </table>

    </div>
</div>
@endsection

