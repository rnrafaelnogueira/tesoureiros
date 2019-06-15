@extends('adminlte::page')

@section('content')
<div class="container">

    <div class="row">
        

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('categorias.edit',['categoria' => $categoria->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('categorias.destroy',['categoria' => $categoria->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['categorias.destroy' , 'categoria'=> $categoria->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$categoria->id}}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{$categoria->nome}}</td>
            </tr>   
            <tr>
                <th scope="row">Detalhes</th>
                <td>{{$categoria->detalhes}}</td>
            </tr>                     
            </tbody>
        </table>

    </div>
</div>
@endsection

