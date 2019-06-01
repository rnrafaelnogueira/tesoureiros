<?php

namespace App\Http\Controllers;

use App\Forms\OrdemServicoForm;
use App\Models\OrdemServico;
use App\Repositories\OrdemServicoRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class OrdemServicoController extends Controller
{
    public function __construct(OrdemServicoRepository $repository)
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

        $ordens_servico =   $this->repository->paginate(10,'data_entrada', 'ASC');

        return view('ordem_servico.index', compact('ordens_servico'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(OrdemServicoForm::class,[
            'url' => route('ordem_servico.store'),
            'method' => 'POST'
        ]);

        return view('ordem_servico.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(OrdemServicoForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Ordem de Serviço adicionado com sucesso.');

        return redirect()->route('ordem_servico.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(OrdemServico $ordem_servico)
    {
        return view('ordem_servico.show', compact('ordem_servico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemServico $ordem_servico)
    {

        $form = FormBuilder::create(OrdemServicoForm::class,[
            'url' => route('ordem_servico.update', ['ordem_servico'=> $ordem_servico->id]),
            'method' => 'PUT',
            'model' => $ordem_servico
        ]);

        return view('ordem_servico.edit', compact('form'));
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
        $form = FormBuilder::create(OrdemServicoForm::class,[
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

        $request->session()->flash('message','Ordem de Serviço alterada com sucesso.');

        return redirect()->route('ordem_servico.index');
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

        $request->session()->flash('message','Ordem de Serviço excluída com sucesso.');

        return redirect()->route('ordem_servico.index');
    }
}
