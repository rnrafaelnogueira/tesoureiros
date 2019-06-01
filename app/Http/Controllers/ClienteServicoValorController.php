<?php

namespace App\Http\Controllers;

use App\Forms\ClienteServicoValorForm;
use App\Models\ClienteServicoValor;
use App\Repositories\ClienteServicoValorRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class ClienteServicoValorController extends Controller
{
    public function __construct(ClienteServicoValorRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cliente_servico_valores =  $this->repository->paginate(10,'id_cliente', 'ASC');

        return view('cliente_servico_valor.index', compact('cliente_servico_valores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(ClienteServicoValorForm::class,[
            'url' => route('cliente_servico_valor.store'),
            'method' => 'POST'
        ]);

        return view('cliente_servico_valor.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(ClienteServicoValorForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Cliente Serviço adicionado com sucesso.');

        return redirect()->route('cliente_servico_valor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteServicoValor $cliente_servico_valor)
    {
        return view('cliente_servico_valor.show', compact('cliente_servico_valor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(ClienteServicoValor $cliente_servico_valor)
    {

        $form = FormBuilder::create(ClienteServicoValorForm::class,[
            'url' => route('cliente_servico_valor.update', ['cliente_servico_valor'=> $cliente_servico_valor->id]),
            'method' => 'PUT',
            'model' => $cliente_servico_valor
        ]);

        return view('cliente_servico_valor.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(ClienteServicoValorForm::class,[
            'data' => ['id'=>$id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->edit($id,$data);

        $request->session()->flash('message','Cliente Serviço alterado com sucesso.');

        return redirect()->route('cliente_servico_valor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Cliente Serviço alterado com sucesso.');

        return redirect()->route('cliente_servico_valor.index');
    }
}
