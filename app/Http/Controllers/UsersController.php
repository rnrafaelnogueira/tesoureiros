<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\User;
use FormBuilder;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PagamentoRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\DespesaRepository;
use App\Repositories\ReceitaRepository;
use App\Repositories\TipoReceitaRepository;
use Kris\LaravelFormBuilder\Form;



class UsersController extends Controller
{

    public function __construct(UserRepository $repository,PagamentoRepository $repository_pagamento ,CategoriaRepository $repository_categoria,DespesaRepository $repository_despesa,  ReceitaRepository $repository_receita, TipoReceitaRepository $repository_tipo_receita)
    {
        $this->repository = $repository;
        $this->repository_pagamento = $repository_pagamento;
        $this->repository_categoria = $repository_categoria;
        $this->repository_despesa = $repository_despesa;
        $this->repository_receita = $repository_receita;
        $this->repository_tipo_receita = $repository_tipo_receita;
        $this->repository_receita = $repository_receita;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (count($request->all()) > 0) {
            $users = $this->repository->paginateWhere(10,'name','ASC',$request->except(['_token','page','flag_download']));
        } else {
            $users = $this->repository->paginate(10,'name','ASC');
        }
     
        if ($request->flag_download == 'Excel'){
            $this->excelUsers($request);
        }
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(UserForm::class,[
            'url' => route('users.store'),
            'method' => 'POST'
        ]);

        return view('users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        if (empty($file)) {
            abort(400, 'Nenhum arquivo foi enviado.');
        }

        $path = $file->store('uploads');

        \Excel::load('storage\app\\'.$path, function($reader) {
            dd($reader->select()->toArray());
        });

        /** @var Form $form */
        $form = FormBuilder::create(UserForm::class);

    /*    if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
*/
        $data = $form->getFieldValues();

       // dd($data);
        $data['password'] = bcrypt($data['password']);

        $this->repository->add($data);

        $request->session()->flash('message','Membro adicionado com sucesso.');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = FormBuilder::create(UserForm::class,[
            'url' => route('users.update', ['user'=> $user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);

        return view('users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {



        /** @var Form $form */
        $form = FormBuilder::create(UserForm::class,[
            'data' => ['id'=>$id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = array_except($form->getFieldValues(), ['password','role']);
        $this->repository->edit($id,$data);

        $request->session()->flash('message','Membro alterado com sucesso.');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Membro excluído com sucesso.');

        return redirect()->route('users.index');
    }

    public function importxls($arquivo){
   
        if ($arquivo == 'TipoEntrada'){
            \Excel::load('TipoEntrada.xlsx', function($reader) {
                 $tipo_receita = $reader->select()->toArray();
     
                 foreach ($tipo_receita as $key => $value) {
                     $this->repository_tipo_receita->add($value);
                 }
            }); 
        }
         else if ($arquivo == 'Entradas'){
            \Excel::load('Entradas.xlsx', function($reader) {
                 $entrada = $reader->select()->toArray();
     
                 foreach ($entrada as $key => $value) {
                     $this->repository_receita->add($value);
                 }
            }); 
        }else if ($arquivo == 'TipoSaida'){
             \Excel::load('TipoSaida.xlsx', function($reader) {
                 $tipo_saidas = $reader->select()->toArray();
     
                 foreach ($tipo_saidas as $key => $value) {
                     $this->repository_categoria->add($value);
                 }
            });     
        }else{
            \Excel::load($arquivo.'.xlsx', function($reader) {
                 $saidas = $reader->select()->toArray();

                 foreach ($saidas as $key => $value) {

                    $despesa['nome']= $value['descricao'];
                    $despesa['id_categoria']= 1;
                    $despesa['id_user']= 1;
                    $despesa['valor_fixo']= $value['valor'];
                    $despesa['data_recibo']= $value['data_recibo'];
                    $despesa['mes']= $value['mes'];
                    $despesa['ano']= $value['ano'];

                    $id_despesa = $this->repository_despesa->add($despesa);

                    $value['id_despesa'] = $id_despesa;

                    $this->repository_pagamento->add($value);
                 }
            });    
       /* }        */
        
    }

    public function excelUsers($request)
    {
        try {
            $resultado = $this->repository->paginateWhere(9999999,'name','ASC',$request->except(['_token','page','flag_download']));

            \Excel::create('usuarios', function($excel) use ($resultado) {
                $excel->sheet('Dizimistas', function($sheet) use ($resultado) {
                    $sheet->loadView('users.excel',['users'=>$resultado]);
                });
            })->download('xls');
        } catch (Exception $e) {
            $request->session()->flash('message',['title'=>'Erro','msg'=>'Erro ao realizar download do excell','color'=>'error']);
        }
    }

}
