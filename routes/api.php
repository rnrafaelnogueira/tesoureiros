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

use App\Mail\MailtrapContato;

ApiRoute::version('v1',function(){
    ApiRoute::group([
        'namespace' => 'App\Http\Controllers\Api' ,
        'as' => 'api' ,
        'middleware' => ['bindings']
    ], function(){

     


        ApiRoute::post('/contate', function (Request $request) {

            $params = $request->input();

            $nome =  $params['nome']; 
            $telefone =  $params['telefone'];
            $mensagem =  $params['mensagem'];
       
                    
            Mail::to('rnrafaelnogueira@gmail.com')->send('mail.contato', ["nome" => $nome, 'telefone' =>  $telefone, 'mensagem' => $mensagem], function ($mail) use ($nome, $telefone, $mensagem){
                $mail->from('rnrafaelnogueira@gmail.com', 'Cliente entranto em contato - LAB NECY VIEIRA');
                $mail->to('rnrafaelnogueira@gmail.com' , 'Web Site')->subject('Cliente entranto em contato - LAB NECY VIEIRA');
                $mail->bcc("necyvnogueira@gmail.br");
            });
            return 'A message has been sent to Mailtrap!';

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
