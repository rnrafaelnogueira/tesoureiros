<?php

namespace App\Http\Controllers;

use App\Forms\DespesaForm;
use App\Models\Despesa;
use App\Repositories\DespesaRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class DespesasController extends Controller
{
    public function __construct(DespesaRepository $repository)
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

        $despesas =  $this->repository->paginate(800,'updated_at', 'ASC');

        return view('despesa.index', compact('despesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(DespesaForm::class,[
            'url' => route('despesas.store'),
            'method' => 'POST'
        ]);

        return view('despesa.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(DespesaForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Despesa adicionado com sucesso.');

        return redirect()->route('despesas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\despesa  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(despesa $despesa)
    {
        return view('despesa.show', compact('despesa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\despesa  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(despesa $despesa)
    {

        $form = FormBuilder::create(DespesaForm::class,[
            'url' => route('despesas.update', ['despesa'=> $despesa->id]),
            'method' => 'PUT',
            'model' => $despesa
        ]);

        return view('despesa.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\despesa  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(DespesaForm::class,[
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

        $request->session()->flash('message','Despesa alterada com sucesso.');

        return redirect()->route('despesas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\despesa  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Despesa excluída com sucesso.');

        return redirect()->route('despesas.index');
    }
}
