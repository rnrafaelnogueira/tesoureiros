<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoReceita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReceitaRepository;
use App\Repositories\UserRepository;
use App\Repositories\TipoReceitaRepository;
use App\Repositories\MesRepository;

class CalendarController extends Controller
{
    protected $receita_repository;

    public function __construct(
    )
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEventsDay(Request $request,$day)
    {
        $json['12-11-2018'][0]['title'] = 'Fica Comigo';
        $json['12-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['12-11-2018'][0]['price_woman'] = '30';
        $json['12-11-2018'][0]['price_man'] = '50';
        $json['12-11-2018'][1]['title'] = 'Fala Comigo';
        $json['12-11-2018'][1]['subtitle'] = 'Usina 5.1';
        $json['12-11-2018'][1]['price_woman'] = '60';
        $json['12-11-2018'][1]['price_man'] = '80';
        $json['12-11-2018'][2]['title'] = 'Liga pra mim';
        $json['12-11-2018'][2]['subtitle'] = 'Usina 6.1';
        $json['12-11-2018'][2]['price_woman'] = '70';
        $json['12-11-2018'][2]['price_man'] = '90';
        $json['12-11-2018'][3]['title'] = 'Liga pra mim denovo';
        $json['12-11-2018'][3]['subtitle'] = 'Usina 6.1';
        $json['12-11-2018'][3]['price_woman'] = '70';
        $json['12-11-2018'][3]['price_man'] = '90';

        $json['15-11-2018'][0]['title'] = 'Fica Comigo outra vez';
        $json['15-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['15-11-2018'][0]['price_woman'] = '35';
        $json['15-11-2018'][0]['price_man'] = '55';
        $json['15-11-2018'][1]['title'] = 'Fala Comigo outra vez';
        $json['15-11-2018'][1]['subtitle'] = 'Usina 5.1';
        $json['15-11-2018'][1]['price_woman'] = '60';
        $json['15-11-2018'][1]['price_man'] = '80';
        $json['15-11-2018'][2]['title'] = 'Liga pra mim outra vez';
        $json['15-11-2018'][2]['subtitle'] = 'Usina 6.1';
        $json['15-11-2018'][2]['price_woman'] = '70';
        $json['15-11-2018'][2]['price_man'] = '90';
        

        $json['18-11-2018'][0]['title'] = 'Fica Comigo denovo';
        $json['18-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['18-11-2018'][0]['price_woman'] = '32';
        $json['18-11-2018'][0]['price_man'] = '51';
        $json['18-11-2018'][1]['title'] = 'Fala Comigo denovo';
        $json['18-11-2018'][1]['subtitle'] = 'Usina 5.1';
        $json['18-11-2018'][1]['price_woman'] = '60';
        $json['18-11-2018'][1]['price_man'] = '80';
        $json['18-11-2018'][2]['title'] = 'Liga pra mim denovo';
        $json['18-11-2018'][2]['subtitle'] = 'Usina 6.1';
        $json['18-11-2018'][2]['price_woman'] = '70';
        $json['18-11-2018'][2]['price_man'] = '90';


        $json['11-11-2018'][0]['title'] = 'Fica Comigo';
        $json['11-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['11-11-2018'][0]['price_woman'] = '36';
        $json['11-11-2018'][0]['price_man'] = '59';

        $json['13-11-2018'][0]['title'] = 'Fica Comigo outra vez';
        $json['13-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['13-11-2018'][0]['price_woman'] = '31';
        $json['13-11-2018'][0]['price_man'] = '51';
        $json['13-11-2018'][1]['title'] = 'Fala Comigo outra vez';
        $json['13-11-2018'][1]['subtitle'] = 'Usina 5.1';
        $json['13-11-2018'][1]['price_woman'] = '60';
        $json['13-11-2018'][1]['price_man'] = '80';

        $json['14-11-2018'][0]['title'] = 'Fica Comigo denovo';
        $json['14-11-2018'][0]['subtitle'] = 'Usina 5';
        $json['14-11-2018'][0]['price_woman'] = '30';
        $json['14-11-2018'][0]['price_man'] = '50';
        $json['14-11-2018'][1]['title'] = 'Fala Comigo denovo';
        $json['14-11-2018'][1]['subtitle'] = 'Usina 5.1';
        $json['14-11-2018'][1]['price_woman'] = '60';
        $json['14-11-2018'][1]['price_man'] = '80';
        $json['14-11-2018'][2]['title'] = 'Liga pra mim denovo';
        $json['14-11-2018'][2]['subtitle'] = 'Usina 6.1';
        $json['14-11-2018'][2]['price_woman'] = '70';
        $json['14-11-2018'][2]['price_man'] = '90';
        $json['14-11-2018'][3]['title'] = 'Liga pra mim denovo';
        $json['14-11-2018'][3]['subtitle'] = 'Usina 6.1';
        $json['14-11-2018'][3]['price_woman'] = '70';
        $json['14-11-2018'][3]['price_man'] = '90';


        return !empty($json[$day]) ? $json[$day] : $json['14-11-2018'];
    }

}