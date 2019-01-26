<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Repositories\PagamentoRepository;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {



        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagamentos = new Pagamento();

        $valor_anual = number_format($pagamentos->sum_valor_ano(2017)+$pagamentos->sum_valor_ano(2018), 2, ',', '.');
        $valor_nov_2017 = $pagamentos->sum_valor_mes(11,2017);
        $valor_dez_2017 = $pagamentos->sum_valor_mes(12,2017);
        $valor_jan_2018 = $pagamentos->sum_valor_mes(1,2018);
        $valor_fev_2018 = $pagamentos->sum_valor_mes(2,2018);
        $valor_mar_2018 = $pagamentos->sum_valor_mes(3,2018);
        $valor_abr_2018 = $pagamentos->sum_valor_mes(4,2018);
        $valor_mai_2018 = $pagamentos->sum_valor_mes(5,2018);
        $valor_jun_2018 = $pagamentos->sum_valor_mes(6,2018);
        $valor_jul_2018 = $pagamentos->sum_valor_mes(7,2018);
        $valor_ago_2018 = $pagamentos->sum_valor_mes(8,2018);
        $valor_set_2018 = $pagamentos->sum_valor_mes(9,2018);
        $valor_out_2018 = $pagamentos->sum_valor_mes(10,2018);
        $valor_nov_2018 = $pagamentos->sum_valor_mes(11,2018);
        $valor_dez_2018 = $pagamentos->sum_valor_mes(12,2018);

        $total_financeiro = [
                'total_despesa_anual'=> $valor_anual,
                'total_despesa_nov_2017'=> $valor_nov_2017,
                'total_despesa_dez_2017'=> $valor_dez_2017,
                'total_despesa_jan_2018'=> $valor_jan_2018,
                'total_despesa_fev_2018'=> $valor_fev_2018,
                'total_despesa_mar_2018'=> $valor_mar_2018,
                'total_despesa_abr_2018'=> $valor_abr_2018,
                'total_despesa_mai_2018'=> $valor_mai_2018,
                'total_despesa_jun_2018'=> $valor_jun_2018,
                'total_despesa_jul_2018'=> $valor_jul_2018,
                'total_despesa_ago_2018'=> $valor_ago_2018,
                'total_despesa_set_2018'=> $valor_set_2018,
                'total_despesa_out_2018'=> $valor_out_2018,
                'total_despesa_nov_2018'=> $valor_nov_2018,
                'total_despesa_dez_2018'=> $valor_dez_2018,
                'total_receita_anual'=> '0',
                'total_receita_nov_2017'=> '0',
                'total_receita_dez_2017'=> 0,
                'total_receita_jan_2018'=> 0,
                'total_receita_fev_2018'=> 0,
                'total_receita_mar_2018'=> 0,
                'total_receita_abr_2018'=> 0,
                'total_receita_mai_2018'=> 0,
                'total_receita_jun_2018'=> 0,
                'total_receita_jul_2018'=> 0,
                'total_receita_ago_2018'=> 0,
                'total_receita_set_2018'=> 0,
                'total_receita_out_2018'=> 0,
                'total_receita_nov_2018'=> 0,
                'total_receita_dez_2018'=> 0
            ];


$categorias = [
'MATERIAL DE USO PERMANENTE',
'CAGECE',
'COELCE',
'CONTA SALÁRIO',
'CONTRATOS',
'CONTRIBUIÇÃO PRESBITÉRIO',
'DECORAÇÃO',
'DEPTO.  DIACONAL',
'DESPESA CARTÓRIO',
'DESPESA COM SEMINARISTA',
'DESPESAS ALIMENTAÇÃO',
'DESPESAS EBD',
'EVENTOS',
'HOMENAGENS',
'IMPRESSÕES e CÓPIAS',
'INVESTIMENTO CONVIVENCIA/VIGILIA',
'INVESTIMENTO EM MISSÕES',
'INVESTIMENTO MINISTÉRIOS',
'MANUTENÇÃO PREDIAL',
'MANUTENÇÃO E CONCERTO DE EQUIPAMENTOS ELETRICOS E ELETRONICOS',
'MATERIAL DE ESCRITORIO',
'MATERIAL DE LIMPEZA',
'ELEMENTOS PARA SANTA CEIA',
'GARRAFÃO DE ÁGUA',
'SERVIÇO PRESTADOS A IGREJA',
'TELEFONE E INTERNET',
'TRANSPORTE/COMBUSTIVEL'];


        return view('home', compact('total_financeiro', 'categorias'));
    }
}

