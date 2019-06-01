<?php

namespace App\Http\Controllers;

use App\Forms\PacienteForm;
use App\Models\Paciente;
use App\Repositories\PacienteRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class PacienteController extends Controller
{
    public function __construct(PacienteRepository $repository)
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

        $pacientes =  $this->repository->paginate(10,'nome', 'ASC');

        return view('paciente.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(PacienteForm::class,[
            'url' => route('paciente.store'),
            'method' => 'POST'
        ]);

        return view('paciente.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(PacienteForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Paciente adicionado com sucesso.');

        return redirect()->route('paciente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\paciente  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\paciente  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {

        $form = FormBuilder::create(PacienteForm::class,[
            'url' => route('paciente.update', ['paciente'=> $paciente->id]),
            'method' => 'PUT',
            'model' => $paciente
        ]);

        return view('paciente.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\paciente  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(PacienteForm::class,[
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

        $request->session()->flash('message','Paciente alterada com sucesso.');

        return redirect()->route('paciente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\paciente  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Paciente excluída com sucesso.');

        return redirect()->route('paciente.index');
    }
}
