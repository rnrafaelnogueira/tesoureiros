<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\OrdemServicoRepository;
use App\Repositories\ClienteServicoValorRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\ServicoRepository;
use App\Repositories\SituacaoRepository;
use App\Repositories\GrupoKanbanRepository;
use App\Http\Controllers\Controller;

class OrdemServicoController extends Controller
{
    protected $ordem_servico_repository;

    public function __construct(
        OrdemServicoRepository $ordem_servico_repository,
        ClienteServicoValorRepository $cliente_servico_valor_repository,
        PacienteRepository $paciente_repository,
        ClienteRepository $cliente_repository,
        ServicoRepository $servico_repository,
        SituacaoRepository $situacao_repository,
        GrupoKanbanRepository $grupo_kanban_repository
    )
    {
        $this->ordem_servico_repository = $ordem_servico_repository;
        $this->cliente_servico_valor_repository = $cliente_servico_valor_repository;
        $this->paciente_repository = $paciente_repository;
        $this->cliente_repository = $cliente_repository;
        $this->servico_repository = $servico_repository;
        $this->situacao_repository = $situacao_repository;
        $this->grupo_kanban_repository = $grupo_kanban_repository;
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

    public function componentes_ordem_servico()
    {
        $clientes = $this->cliente_repository->all();
        $servicos = $this->servico_repository->all();
        $situacoes = $this->situacao_repository->all();
        $grupos_kanban = $this->grupo_kanban_repository->all();

        return response()->json(['clientes' => $clientes , 'servicos' => $servicos, 'situacoes' => $situacoes, 'grupos_kanban'=> $grupos_kanban]);
    }

    public function get(Request $request,$id)
    {

        $ordens_servico = $this->ordem_servico_repository->where('id',$id)->all();
            

        $ordens_servico[0]['cliente'] = $ordens_servico[0]->cliente_join()->first()->nome;
        $ordens_servico[0]['nome_paciente'] = $ordens_servico[0]->paciente_join()->first()->nome;
        $ordens_servico[0]['obs_paciente'] = $ordens_servico[0]->paciente_join()->first()->observacao;
        $ordens_servico[0]['situacao'] = $ordens_servico[0]->situacao_join()->first()->nome;
        $ordens_servico[0]['grupo_kanban'] = $ordens_servico[0]->grupo_kanban_join()->first()->nome;
        $ordens_servico[0]['servico'] = $ordens_servico[0]->servico_join()->first()->nome;
        $ordens_servico[0]['valor_padrao'] = ($ordens_servico[0]->valor_padrao == 'S') ? 'Sim' : 'Não';
        
        

        return response()->json($ordens_servico);
    }

    public function update(Request $request)
    {
        $data = $request->input();

        unset($data['data_previsao_entrega']);

        if($data['valor_padrao'] == 'S'){
            $data['valor_unitario'] =  $this->cliente_servico_valor_repository->where('id_cliente',$data['id_cliente'])->where('id_servico',$data['id_servico'])->pluck('valor')->first();
        }

        $arr_paciente['nome'] = $data['nome_paciente'];
        $arr_paciente['observacao'] = $data['obs_paciente'];

        $data['valor_total'] = $data['valor_unitario'] * $data['quantidade'];
        $id = $data['id'];
        
        unset($data['id']);


        unset($data['nome_paciente']);
        unset($data['obs_paciente']);

        $id_paciente = $this->paciente_repository->edit($data['id_paciente'], $arr_paciente);


        $this->ordem_servico_repository->edit($id,$data);

        return  response()->json($data);
    }

    public function destroy(Request $request,$id)
    {

        $this->ordem_servico_repository->delete($id);

        return  response()->json(["success" => true]);
    }

}