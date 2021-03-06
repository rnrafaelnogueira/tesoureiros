<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Mail\Contate;
use App\Mail\Solicitacao;

ApiRoute::version('v1',function(){
    ApiRoute::group([
        'namespace' => 'App\Http\Controllers\Api' ,
        'as' => 'api' ,
        'middleware' => ['bindings']
    ], function(){

     


        ApiRoute::post('/contate', function (Request $request) {

            $params = $request->input();
                    
            Mail::to('rnrafaelnogueira@gmail.com')->send(new Contate($params['nome'], $params['telefone'],$params['mensagem'])); 

            return 'A mensagem foi enviada, aguarde entraremos em contato.';

        });

        ApiRoute::post('/solicitacao', function (Request $request) {

            $params = $request->input();

            Mail::to('rnrafaelnogueira@gmail.com')->send(new Solicitacao($params['servico'],$params['nome'], $params['telefone'],$params['detalhes'])); 

            return 'A solicitação foi enviada, aguarde entraremos em contato.';

        });

        ApiRoute::post('/access_token', [
            'uses' => 'AuthController@accessToken'/*,
            'middleware' => ['api.throttle'],
            'limit' => 100,
            'expires' => 100*/
        ])->name('.access_token');

        ApiRoute::post('/refresh_token', [
            'uses' => 'AuthController@refreshToken'/*,
            'middleware' => 'api.throttle',
            'limit' => 10,
            'expires' => 1*/
        ])->name('.refresh_token');

        ApiRoute::post('/register', 'RegisterUsersController@store');

        ApiRoute::group(['middleware' => [/*'api.throttle',*/ 'api.auth']
            /*, 'limit' => 10000
            , 'expires' =>300000*/
        ], function(){
            ApiRoute::post('/receita', 'ReceitaController@index');
            ApiRoute::post('/ordem_servico', 'OrdemServicoController@store');
            ApiRoute::put('/ordem_servico', 'OrdemServicoController@update');
            ApiRoute::delete('/ordem_servico/{id}', 'OrdemServicoController@destroy');
            ApiRoute::get('/ordem_servico/by_id/{id}', 'OrdemServicoController@get');
            ApiRoute::get('/ordem_servico/componentes', 'OrdemServicoController@componentes_ordem_servico');

            ApiRoute::get('/kanban', 'KanbanController@index');
            ApiRoute::get('/kanban/ordens_servico/{grupo_kanban}', 'KanbanController@ordens_servico');
            ApiRoute::get('/resumo_valor', 'ResumoValorController@index');

            ApiRoute::get('/calendar/{day}', 'CalendarController@getEventsDay');
        });
    });
});
