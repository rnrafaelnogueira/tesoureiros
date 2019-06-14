<?php

namespace App\Repositories;

use App\Models\OrdemServico;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;
use App\Models\ClienteServicoValor;


class OrdemServicoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        OrdemServico $model, ClienteServicoValor $model_cliente_valor
    )
    {
        $this->model = $model;
        $this->model_cliente_valor = $model_cliente_valor;

    }


     public function valor_cliente_servico($data)
    {

    	
        return  $this->model->hasOne($this->model_cliente_valor, 'id_cliente',$data['id_cliente'])->where('id_servico', $data['id_servico'])->get()->pluck('valor')->first();
    }


}