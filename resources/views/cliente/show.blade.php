@extends('adminlte::page')

@section('content')
<div class="container">

    <div class="row">
        

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('cliente.edit',['cliente' => $cliente->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('cliente.destroy',['cliente' => $cliente->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['cliente.destroy' , 'cliente'=> $cliente->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$cliente->id}}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{$cliente->nome}}</td>
            </tr>   
            <tr>
                <th scope="row">Telefone</th>
                <td>{{$cliente->telefone}}</td>
            </tr>   
            <tr>
                <th scope="row">Endereço</th>
                <td>{{$cliente->endereco}}</td>
            </tr>                     
            </tbody>
        </table>

    </div>
</div>
@endsection

