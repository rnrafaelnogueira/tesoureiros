<?php

namespace App\Http\Controllers;

use App\Forms\PagamentoForm;
use App\Models\Pagamento;
use App\Repositories\PagamentoRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use FormBuilder;

class PagamentosController extends Controller
{
    public function __construct(PagamentoRepository $repository)
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
            $pagamentos = $this->repository->paginateWhere(10,'data_cadastro','ASC',$request->except(['_token','page']));
        } else {
            $pagamentos = $this->repository->paginate(10,'data_cadastro','ASC');
        }

        return view('pagamento.index', compact('pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(PagamentoForm::class,[
            'url' => route('pagamentos.store'),
            'method' => 'POST'
        ]);

        return view('pagamento.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(PagamentoForm::class);

        /*    if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
    */
        $data = $form->getFieldValues();

        $this->repository->add($data);

        $request->session()->flash('message','Pagamento adicionado com sucesso.');

        return redirect()->route('pagamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\pagamento  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(pagamento $pagamento)
    {
        return view('pagamento.show', compact('pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\pagamento  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(pagamento $pagamento)
    {

        $form = FormBuilder::create(PagamentoForm::class,[
            'url' => route('pagamentos.update', ['pagamento'=> $pagamento->id]),
            'method' => 'PUT',
            'model' => $pagamento
        ]);

        return view('pagamento.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\\pagamento  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(PagamentoForm::class,[
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

        $request->session()->flash('message','Pagamento alterado com sucesso.');

        return redirect()->route('pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\\pagamento  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message','Pagamento excluído com sucesso.');

        return redirect()->route('pagamentos.index');
    }
}
