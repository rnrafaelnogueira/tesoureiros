<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Despesa;
use App\Models\Categoria;
use App\Models\Receita;
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


        $receita = new Receita();

        $valor_anual_receita = number_format($receita->sum_valor_ano(2017)+$receita->sum_valor_ano(2018), 2, ',', '.');
        $valor_nov_2017_receita = $receita->sum_valor_mes(11,2017);
        $valor_dez_2017_receita = $receita->sum_valor_mes(12,2017);
        $valor_jan_2018_receita = $receita->sum_valor_mes(1,2018);
        $valor_fev_2018_receita = $receita->sum_valor_mes(2,2018);
        $valor_mar_2018_receita = $receita->sum_valor_mes(3,2018);
        $valor_abr_2018_receita = $receita->sum_valor_mes(4,2018);
        $valor_mai_2018_receita = $receita->sum_valor_mes(5,2018);
        $valor_jun_2018_receita = $receita->sum_valor_mes(6,2018);
        $valor_jul_2018_receita = $receita->sum_valor_mes(7,2018);
        $valor_ago_2018_receita = $receita->sum_valor_mes(8,2018);
        $valor_set_2018_receita = $receita->sum_valor_mes(9,2018);
        $valor_out_2018_receita = $receita->sum_valor_mes(10,2018);
        $valor_nov_2018_receita = $receita->sum_valor_mes(11,2018);
        $valor_dez_2018_receita = $receita->sum_valor_mes(12,2018);

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
                'total_receita_anual'=> $valor_anual_receita,
                'total_receita_nov_2017'=>$valor_nov_2017_receita,
                'total_receita_dez_2017'=>$valor_dez_2017_receita,
                'total_receita_jan_2018'=>$valor_jan_2018_receita,
                'total_receita_fev_2018'=>$valor_fev_2018_receita,
                'total_receita_mar_2018'=>$valor_mar_2018_receita,
                'total_receita_abr_2018'=>$valor_abr_2018_receita,
                'total_receita_mai_2018'=>$valor_mai_2018_receita,
                'total_receita_jun_2018'=>$valor_jun_2018_receita,
                'total_receita_jul_2018'=>$valor_jul_2018_receita,
                'total_receita_ago_2018'=>$valor_ago_2018_receita,
                'total_receita_set_2018'=>$valor_set_2018_receita,
                'total_receita_out_2018'=>$valor_out_2018_receita,
                'total_receita_nov_2018'=>$valor_nov_2018_receita,
                'total_receita_dez_2018'=>$valor_dez_2018_receita,
            ];



$categorias_bd = new Categoria;
$categorias = $categorias_bd::all()->toArray();

$meses_2017 = [11,12];
$meses_2018_1semestre = [1,2,3,4,5,6];
$meses_2018_2semestre =[7,8,9,10,11,12];

        $despesa = new Despesa();

        foreach ($meses_2017 as $key => $mes2017) {

            # code...
            foreach ($categorias as $key => $categoria) {
                $total_por_categoria_2017[$categoria['nome']][0] = $categoria['nome'];
                $total_por_categoria_2017[$categoria['nome']][$mes2017] = $despesa->sum_valor_categoria($categoria['id'], $mes2017, '2017');
            }
        }

        foreach ($meses_2018_1semestre as $key => $mes20181semestre) {

            # code...
            foreach ($categorias as $key => $categoria) {
                $total_por_categoria_20181[$categoria['nome']][0] = $categoria['nome'];
                $total_por_categoria_20181[$categoria['nome']][$mes20181semestre] = $despesa->sum_valor_categoria($categoria['id'], $mes20181semestre, '2018');
            }
        }
        


        foreach ($meses_2018_2semestre as $key => $mes20182semestre) {

            # code...
            foreach ($categorias as $key => $categoria) {
                $total_por_categoria_20182[$categoria['nome']][0] = $categoria['nome'];
                $total_por_categoria_20182[$categoria['nome']][$mes20182semestre] = $despesa->sum_valor_categoria($categoria['id'], $mes20182semestre, '2018');
            }
        }

        return view('home', compact('total_financeiro', 'total_por_categoria_2017','total_por_categoria_20181', 'total_por_categoria_20182'));
    }
}

