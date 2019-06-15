@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Faturas</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('fatura.create')) !!}
    </div>
    <div class="row">
        {!! form($form->add('buscar', 'submit', [
              'attr' =>['class' => 'btn btn-primary btn-block'],
              'label' => 'Buscar'
                ]))
        !!}
        <div class="box-body">
              <div class="table-responsive">
            {!! Table::withContents($faturas->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $fatura){
                $linkEdit = route('fatura.edit', ['fatura'=> $fatura->id]);
                $linkShow = route('fatura.show', ['fatura'=> $fatura->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            }); !!}
            </div>
        </div>
    </div>
    {!! $faturas->links() !!}
</div>

@endsection