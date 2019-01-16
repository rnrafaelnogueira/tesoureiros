<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\User;
use FormBuilder;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PagamentoRepository;
use Kris\LaravelFormBuilder\Form;



class UsersController extends Controller
{

    public function __construct(UserRepository $repository,PagamentoRepository $repository_pagamento )
    {
        $this->repository = $repository;
        $this->repository_pagamento = $repository_pagamento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  $this->repository->paginate(10,'name', 'ASC');

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

    public function importxls(){
        \Excel::load('Saidas.xlsx', function($reader) {
             $saidas = $reader->select()->toArray();

             foreach ($saidas as $key => $value) {
                 $this->repository_pagamento->add($value);
             }
        });
    }
}
