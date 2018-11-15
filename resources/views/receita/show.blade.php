@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h3>Ver Receita</h3>

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('receitas.edit',['receita' => $receita->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('receitas.destroy',['receita' => $receita->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['receitas.destroy' , 'receita'=> $receita->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$receita->id}}</td>
            </tr>
            <tr>
                <th scope="row">Valor</th>
                <td>{{$receita->valor}}</td>
            </tr>
            <tr>
                <th scope="row">Membro</th>
                <td>{{$receita->user_join()->first()->name}}</td>
            </tr>
            <tr>
                <th scope="row">Mês</th>
                <td>{{$receita->mes_join()->first()->descricao}}</td>
            </tr>
            <tr>
                <th scope="row">Tipo Receita</th>
                <td>{{$receita->tipo_receita_join()->first()->descricao}}</td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection

