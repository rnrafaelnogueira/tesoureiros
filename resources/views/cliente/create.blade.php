@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h3>Novo</h3>
        <?php $icon = Icon::create('floppy-disk');?>
        {!! form($form->add('salve', 'submit', [
          'attr' =>['class' => 'btn btn-primary btn-block'],
          'label' => $icon
            ]))
        !!}
    </div>
</div>
@endsection

