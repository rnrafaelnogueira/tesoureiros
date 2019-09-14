<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\OrdemServicoRepository;
use App\Repositories\ClienteServicoValorRepository;
use App\Repositories\PacienteRepository;
use App\Http\Controllers\Controller;

class OrdemServicoController extends Controller
{
    protected $ordem_servico_repository;

    public function __construct(
        OrdemServicoRepository $ordem_servico_repository,
        ClienteServicoValorRepository $cliente_servico_valor_repository,
        PacienteRepository $paciente_repository
    )
    {
        $this->ordem_servico_repository = $ordem_servico_repository;
        $this->cliente_servico_valor_repository = $cliente_servico_valor_repository;
        $this->paciente_repository = $paciente_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    public function store(Request $request)
    {

        $data = $request->input();

        unset($data['data_previsao_entrega']);

        
        if($data['valor_padrao'] == 'S'){
            $data['valor_unitario'] =  $this->cliente_servico_valor_repository->where('id_cliente',$data['id_cliente'])->where('id_servico',$data['id_servico'])->pluck('valor')->first();
        }

        $data['valor_total'] = $data['valor_unitario'] * $data['quantidade'];


        $arr_paciente['nome'] = $data['nome_paciente'];
        $arr_paciente['observacao'] = $data['obs_paciente'];

        unset($data['nome_paciente']);
        unset($data['obs_paciente']);

        $id_paciente = $this->paciente_repository->addWithId($arr_paciente);

        $data['id_paciente'] = $id_paciente;
        $this->ordem_servico_repository->add($data);

        return  response()->json($data);
    }

}