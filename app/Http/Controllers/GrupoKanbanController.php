<?php

namespace App\Http\Controllers;

use App\Forms\GrupoKanbanForm;
use App\Models\GrupoKanban;
use App\Repositories\GrupoKanbanRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class GrupoKanbanController extends Controller
{
    public function __construct(GrupoKanbanRepository $repository)
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

        $grupos_kanban =  $this->repository->paginate(10,'nome', 'ASC');

        return view('grupo_kanban.index', compact('grupos_kanban'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(GrupoKanbanForm::class,[
            'url' => route('grupo_kanban.store'),
            'method' => 'POST'
        ]);

        return view('grupo_kanban.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(GrupoKanbanForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Grupo Kanban adicionado com sucesso.');

        return redirect()->route('grupo_kanban.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoKanban $grupo_kanban)
    {
        return view('grupo_kanban.show', compact('grupo_kanban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoKanban $grupo_kanban)
    {

        $form = FormBuilder::create(GrupoKanbanForm::class,[
            'url' => route('grupo_kanban.update', ['grupo_kanban'=> $grupo_kanban->id]),
            'method' => 'PUT',
            'model' => $grupo_kanban
        ]);

        return view('grupo_kanban.edit', compact('form'));
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
        $form = FormBuilder::create(GrupoKanbanForm::class,[
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

        $request->session()->flash('message','Grupo Kanban alterado com sucesso.');

        return redirect()->route('grupo_kanban.index');
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

        $request->session()->flash('message','Grupo Kanban excluído com sucesso.');

        return redirect()->route('grupo_kanban.index');
    }
}
