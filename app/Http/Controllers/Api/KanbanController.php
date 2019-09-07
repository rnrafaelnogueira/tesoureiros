<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\OrdemServicoRepository;
use App\Http\Controllers\Controller;

class KanbanController extends Controller
{
    protected $ordem_servico_repository;

    public function __construct(
        OrdemServicoRepository $ordem_servico_repository
    )
    {
        $this->ordem_servico_repository = $ordem_servico_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cpf = $request->get('cpf');
        $ordem_servico = $this->ordem_servico_repository->all();
        $json = [];
        $kanban = [];
        foreach ($ordem_servico  as $key => $value){
            $arr_os = [];
            $kanban[$value->grupo_kanban_join()->first()->nome]['title'] = $value->grupo_kanban_join()->first()->nome;
            $kanban[$value->grupo_kanban_join()->first()->nome]['note'] = $value->grupo_kanban_join()->first()->nome;
            $arr_os['nome'] = $value->cliente_join()->first()->nome;
            $arr_os['paciente'] = $value->paciente_join()->first()->nome;
            $kanban[$value->grupo_kanban_join()->first()->nome]['situacao'][$value->situacao_join()->first()->nome][] = $arr_os;
        }

        $kanban =array_values($kanban);

        foreach($kanban as $key => $value){
            $kanban[$key]['situacao'] = array_values($kanban[$key]['situacao']);
        }

        return response()->json($kanban);
    }

}