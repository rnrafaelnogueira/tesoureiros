@extends('adminlte::page')


@section('content')


<div class="container">
    <div class="row">
        <h2>Dizimistas/Ofertantes</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('users.create')) !!}
    </div>
    <div class="row">
        <?php $icon = Icon::create('floppy-disk');?>
        
         {!! Form::open([ route('users.index') ,'class'=>'form' ,'method' => 'GET']) !!}
            <div class="form-body">
                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Nome</label>
                            {!! Form::text('name','',['name'=>'name','class'=>'form-control']) !!}
                            <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                            <button type="submit" class="btn btn-lg font-medium-1 mb-1 block-page"><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
                </div>

            </div>
        {!! Form::close() !!}

        {!! Table::withContents($users->items())->striped()->bordered()->condensed()
 ->hover()->callback('Ações', function($field, $user){
                $linkEdit = route('users.edit', ['user' => $user->id]);
                $linkShow = route('users.show', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                       Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })!!}
    </div>
    {!! $users->links() !!}
</div>

@endsection