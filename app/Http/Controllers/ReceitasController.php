<?php

namespace App\Http\Controllers;

use App\Forms\ReceitaForm;
use App\Models\Receita;
use App\Repositories\ReceitaRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class ReceitasController extends Controller
{
    public function __construct(ReceitaRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if (count($request->all()) > 0) {
            $receitas = $this->repository->paginateWhere(10,'data_recibo','ASC',$request->except(['_token','page']));
        } else {
            $receitas = $this->repository->paginate(10,'data_recibo','ASC');
        }

        return view('receita.index', compact('receitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(ReceitaForm::class,[
            'url' => route('receitas.store'),
            'method' => 'POST'
        ]);

        return view('receita.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(ReceitaForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Receita adicionado com sucesso.');

        return redirect()->route('receitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(Receita $receita)
    {
        return view('receita.show', compact('receita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(Receita $receita)
    {

        $form = FormBuilder::create(ReceitaForm::class,[
            'url' => route('receitas.update', ['receita'=> $receita->id]),
            'method' => 'PUT',
            'model' => $receita
        ]);

        return view('receita.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(ReceitaForm::class,[
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

        $request->session()->flash('message','Receita alterada com sucesso.');

        return redirect()->route('receitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Receita excluída com sucesso.');

        return redirect()->route('receitas.index');
    }
}
