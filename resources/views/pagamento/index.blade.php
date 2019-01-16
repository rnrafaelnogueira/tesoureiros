@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Saídas</h2><br>
        {!! Button::success('Novo')->asLinkTo(route('pagamentos.create')) !!}
    </div>
    <div class="row">
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



