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
                            <label>Download</label>
                            {!! Form::text('flag_download','',['flag_download'=>'flag_download','class'=>'form-control']) !!}                          
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


@section('script')

    <script type="text/javascript">

        function excelUsers() {
            swal(
                {
                    title: "Exportar resultado para o excel?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {

                        var token = $("input[name='_token']").val();
                        var name = $("input[name='name']").val();

                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '{{ url("ajax/excel_usuarios") }}',
                            data: {
                                _token: token,
                                name : name,
                            },

                            success: function(data) {
                                swal("Sucesso!","Exportação realizada com sucesso.", "success");
                                var url = '{{ Request::url() }}/excel_usuarios?&id_turma='+id_turma+'&id_curso='+id_curso+'&nome_curso='+nome_curso+'&id_modalidade='+id_modalidade+'&curso_incompany='+curso_incompany+'&id_turno='+id_turno+'&id_local_realizacao='+id_local_realizacao+'&id_cidade='+id_cidade+'&status_turma='+status_turma+'&data_inicio='+data_inicio+'&data_fim='+data_fim;
                                window.open(url);
                            },

                            error: function(data) {
                                console.log(data);
                                swal("Erro","Não foi possível realizar a exportação do dados. Tente novamente","error");
                            }
                        });
                    }
                }
            );
        }

    </script>

@stop
