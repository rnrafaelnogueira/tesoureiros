<?php

namespace App\Http\Controllers;

use App\Forms\ReceitaForm;
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
    public function index()
    {

        $receita =  $this->repository->paginate(10,'id_user', 'ASC');

        return view('receita.index', compact('receita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(ReceitaForm::class,[
            'url' => route('receita.store'),
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

        return redirect()->route('receita.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(Receita $dizimos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(Receita $dizimos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receita $dizimos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\Receita  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receita $dizimos)
    {
        //
    }
}
