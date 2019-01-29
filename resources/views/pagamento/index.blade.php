@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Saídas</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('pagamentos.create')) !!}
    </div>
    <div class="row">
      {!! Form::open([route('pagamentos.index'),'class'=>'form' ,'method' => 'GET']) !!}
            <div class="form-body">
                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('descricao') ? ' has-danger' : '' }}">
                            <label>Nome</label>
                            {!! Form::text('descricao','',['descricao'=>'descricao','class'=>'form-control']) !!}
                            <span class="help-block text-danger">{{ $errors->first('descricao') }}</span>
                            <button type="submit" class="btn btn-lg font-medium-1 mb-1 block-page"><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
                </div>

            </div>
        {!! Form::close() !!}
        
        {!! Table::withContents($pagamentos->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $pagamento){
                $linkEdit = route('pagamentos.edit', ['pagamento' => $pagamento->id]);
                $linkShow = route('pagamentos.show', ['pagamento' => $pagamento->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $pagamentos->links() !!}
</div>

@endsection



