<?php

namespace App\Http\Controllers;

use App\Forms\FaturaForm;
use App\Repositories\FaturaRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use PDF;
use FormBuilder;

class FaturaController extends Controller
{
    public function __construct(FaturaRepository $repository)
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
        $form = FormBuilder::create(FaturaForm::class,[
            'url' => route('fatura.index'),
            'method' => 'GET'
        ]);

        $data = $form->getFieldValues();

        $flag_gerar_pdf = $data['gerar_pdf'];

        $data['referencia'] = $data['mes_referencia'].'/'.$data['ano_referencia'];

        unset($data['gerar_pdf']);
        unset($data['ano_referencia']);
        unset($data['mes_referencia']);

        $faturas = $this->repository->paginateWhere(10,'data_geracao','ASC',$data);

        if ($flag_gerar_pdf == 'S'){
           $pdf = PDF::loadView('fatura.pdf', ['faturas'=>$faturas]);

           return $pdf->download('invoice.pdf');
        }else{
            return view('fatura.index', compact('faturas','form'));    
        }       
        
    }

  public function pdfFatura($faturas)
    {
        try {

            $pdf = PDF::loadView('fatura.pdf', ['faturas'=>$faturas]);

            return $pdf->download('invoice.pdf');

        } catch (Exception $e) {
            $request->session()->flash('message',['title'=>'Erro','msg'=>'Erro ao realizar download do pdf.','color'=>'error']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(FaturaForm::class,[
            'url' => route('fatura.store'),
            'method' => 'POST'
        ]);

        return view('fatura.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(FaturaForm::class);

        $data = $form->getFieldValues();

        $data['referencia'] = $data['mes_referencia'].'/'.$data['ano_referencia'];

        unset($data['gerar_pdf']);
        unset($data['ano_referencia']);
        unset($data['mes_referencia']);

        $this->repository->add($data);

        $request->session()->flash('message','Fatura adicionada com sucesso.');

        return redirect()->route('fatura.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function show(Fatura $fatura)
    {
        return view('fatura.show', compact('fatura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\\Categoria  $dizimos
     * @return \Illuminate\Http\Response
     */
    public function edit(Fatura $fatura)
    {

        $form = FormBuilder::create(FaturaForm::class,[
            'url' => route('fatura.update', ['fatura'=> $fatura->id]),
            'method' => 'PUT',
            'model' => $fatura
        ]);

        return view('fatura.edit', compact('form'));
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
        $form = FormBuilder::create(FaturaForm::class,[
            'data' => ['id'=>$id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        unset($data['gerar_pdf']);

        $this->repository->edit($id,$data);

        $request->session()->flash('message','Fatura alterada com sucesso.');

        return redirect()->route('fatura.index');
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

        $request->session()->flash('message','Fatura excluída com sucesso.');

        return redirect()->route('fatura.index');
    }
}
