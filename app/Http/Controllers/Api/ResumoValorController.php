<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\OrdemServicoRepository;
use App\Repositories\ClienteRepository;
use App\Http\Controllers\Controller;

class ResumoValorController extends Controller
{
    protected $ordem_servico_repository;

    public function __construct(
        OrdemServicoRepository $ordem_servico_repository,
        ClienteRepository $cliente_repository
    )
    {
        $this->ordem_servico_repository = $ordem_servico_repository;
        $this->cliente_repository = $cliente_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	$cliente = $this->cliente_repository->all();

        foreach ($cliente as $key => $value) {
        	$arr_principal['labels'][] = $value->nome;
        	$arr_data[] = $this->ordem_servico_repository->where('id_cliente', $value->id)
        	->where('id_grupo_kanban',4)
        	->whereIn('id_situacao',[2,5])
        	->sum('valor_total');
        }

		$arr_backgound_color =  [
		            'rgba(255, 159, 64)',
		            'rgba(255, 99, 132)',
		            'rgba(54, 162, 235)'
		          ];
		$arr_hover_background_color = [
		            '#FFCE56',
		            '#FF6384',
		            '#36A2EB'
		          ];
		$arr_principal['datasets'][0]['data'] = $arr_data;
		$arr_principal['datasets'][0]['backgroundColor'] = $arr_backgound_color;
		$arr_principal['datasets'][0]['hoverBackgroundColor'] = $arr_hover_background_color;

        return response()->json($arr_principal);
    }

    public function ordens_servico(Request $request,$grupo_kanban)
    {
        
        $ordens_servico = $this->ordem_servico_repository->where('id_grupo_kanban',$grupo_kanban);

        
        $json = [];
        $kanban = [];
        foreach ($ordens_servico as $key => $value){
            $arr_os = [];
            $kanban[$value->situacao_join()->first()->nome]['title'] = $value->situacao_join()->first()->nome;
            $kanban[$value->situacao_join()->first()->nome]['note'] = $value->situacao_join()->first()->nome;
            $arr_os['id'] = $value->id;
            $arr_os['nome'] = $value->cliente_join()->first()->nome;
            $arr_os['paciente'] = $value->paciente_join()->first()->nome;
            $kanban[$value->situacao_join()->first()->nome]['ordens_servico'][] = $arr_os;
        }

        $kanban =array_values($kanban);


        foreach($kanban as $key => $value){
            $kanban[$key]['ordens_servico'] = array_values($kanban[$key]['ordens_servico']);
        }
        return response()->json($kanban);
    }

}