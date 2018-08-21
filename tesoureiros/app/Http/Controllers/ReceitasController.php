<?php

namespace App\Http\Controllers;

use App\Repositories\ReceitaRepository;
use Illuminate\Http\Request;

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
        $receitas =  $this->repository->paginate(10,'name', 'ASC');
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
        //
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
