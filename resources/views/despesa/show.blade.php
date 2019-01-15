@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h3>Ver Despesa</h3>

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('despesas.edit',['despesa' => $despesa->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('despesas.destroy',['despesa' => $despesa->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['despesas.destroy' , 'despesa'=> $despesa->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$despesa->id}}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{$despesa->nome}}</td>
            </tr>
            <tr>
                <th scope="row">Membro</th>
                <td>{{$despesa->user_join()->first()->name}}</td>
            </tr>
            <tr>
                <th scope="row">Categoria</th>
                <td>{{$despesa->categoria_join()->first()->nome}}</td>
            </tr>
             <tr>
                <th scope="row">Valor Fixo</th>
                <td>{{$despesa->valor_fixo}}</td>
            </tr>

            </tbody>
        </table>

    </div>
</div>
@endsection

