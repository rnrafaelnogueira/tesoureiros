<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoReceita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReceitaRepository;
use App\Repositories\UserRepository;
use App\Repositories\TipoReceitaRepository;
use App\Repositories\MesRepository;

class ReceitaController extends Controller
{
    protected $receita_repository;

    public function __construct(
        ReceitaRepository $receita_repository,
        UserRepository $user_repository,
        TipoReceitaRepository $tipo_receita_repository,
        MesRepository $mes_repository
    )
    {
        $this->receita_repository = $receita_repository;
        $this->user_repository = $user_repository;
        $this->tipo_receita_repository = $tipo_receita_repository;
        $this->mes_repository = $mes_repository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cpf = $request->get('cpf');
        $user = $this->user_repository->where('cpf', $cpf)->first();
        $receita = $this->receita_repository->where('id_user', $user->id);

        $json['nome'] = $user->name;
        foreach ($receita  as $key => $value){
            $tipo_receita = $this->tipo_receita_repository->where('id', $value->tipo_receita)->first();
            $mes = $this->mes_repository->where('id', $value->mes)->first();
            $json['entradas'][$key]['tipo'] = $tipo_receita->descricao;
            $json['entradas'][$key]['valor'] = $value['valor'];
            $json['entradas'][$key]['mes'] = $mes->descricao;

        }



        return response()->json($json);
    }

}