@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Ordens de Serviço</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('ordem_servico.create')) !!}
    </div>
    <div class="row">
        {!! form($form->add('buscar', 'submit', [
              'attr' =>['class' => 'btn btn-primary btn-block'],
              'label' => 'Buscar'
                ]))
        !!}
        <div class="box-body">
              <div class="table-responsive">
            {!! Table::withContents($ordens_servico->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $ordem_servico){
                $linkEdit = route('ordem_servico.edit', ['ordem_servico'=> $ordem_servico->id]);
                $linkShow = route('ordem_servico.show', ['ordem_servico'=> $ordem_servico->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            });
            !!}
            </div>
        </div>
    </div>
    {!! $ordens_servico->links() !!}
</div>

@endsection