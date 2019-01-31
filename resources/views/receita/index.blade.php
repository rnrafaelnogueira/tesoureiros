@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Entrada</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('receitas.create')) !!}
    </div>
    <div class="row">

        {!! Form::open([route('receitas.index'),'class'=>'form' ,'method' => 'GET']) !!}
            <div class="form-body">
                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('nome') ? ' has-danger' : '' }}">
                            <label>Nome</label>
                            {!! Form::text('nome','',['nome'=>'nome','class'=>'form-control']) !!}
                            <span class="help-block text-danger">{{ $errors->first('nome') }}</span>
                             {!! Form::text('flag_download','',['flag_download'=>'flag_download','class'=>'form-control']) !!}         
                             <span class="help-block text-danger">{{ $errors->first('flag_download') }}</span>                 
                            <button type="submit" class="btn btn-lg font-medium-1 mb-1 block-page"><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
                </div>

            </div>
        {!! Form::close() !!}

        {!! Table::withContents($receitas->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $receita){
                $linkEdit = route('receitas.edit', ['receita' => $receita->id]);
                $linkShow = route('receitas.show', ['receita' => $receita->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $receitas->links() !!}
</div>

@endsection



