@extends('adminlte::page')

@section('content')
<div class="container">

    <div class="row">
        

        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('fatura.edit',['fatura' => $fatura->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('fatura.destroy',['fatura' => $fatura->id]))
             ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])!!}
        <?php $formDelete = FormBuilder::plain([
            'id' => 'form-delete',
            'route' => ['fatura.destroy' , 'fatura'=> $fatura->id],
            'method' => 'DELETE',
            'style' => 'display:none'
        ])?>
        {!! form($formDelete) !!}
        <br/><br/>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$fatura->id}}</td>
            </tr>
            <tr>
                <th scope="row">Data Geração</th>
                <td>{{$fatura->data_geracao}}</td>
            </tr>   
            <tr>
                <th scope="row">Cliente</th>
                <td>{{$fatura->cliente_join()->first()->nome}}</td>
            </tr>  
            <tr>
                <th scope="row">Referência</th>
                <td>{{$fatura->referencia}}</td>
            </tr>                     
            </tbody>
        </table>

    </div>
</div>
@endsection

