<?php

namespace App\Http\Controllers;

use App\Forms\FaturaForm;
use App\Repositories\FaturaRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\FaturaOrdemServicoRepository;
use App\Repositories\OrdemServicoRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use PDF;
use DB;
use FormBuilder;
use DateTime;

class FaturaController extends Controller
{
    public function __construct(FaturaRepository $repository, FaturaOrdemServicoRepository $repository_fatura_ordem_servico, OrdemServicoRepository $repository_ordem_servico)
    {
        $this->repository = $repository;
        $this->repository_fatura_ordem_servico = $repository_fatura_ordem_servico;
        $this->repository_ordem_servico = $repository_ordem_servico;
        
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

  public function pdf($fatura)
    {
        try {

            $fatura = $this->repository->where('id',$fatura)->first();
            $info_fatura['id_fatura'] = $fatura->id;
            $data_geracao = new DateTime($fatura->data_geracao);
            $info_fatura['data_geracao'] = $data_geracao->format('d/m/Y');
            $data_vencimento = new DateTime($fatura->data_geracao);
            $info_fatura['data_vencimento'] = $data_vencimento->modify('+3 Days')->format('d/m/Y');
            $info_fatura['referencia'] = $fatura->referencia;
            $info_fatura['nome_cliente'] = $fatura->cliente_join()->first()->nome;
            $info_fatura['telefone_cliente'] = $fatura->cliente_join()->first()->telefone;
            $info_fatura['endereco_cliente'] = $fatura->cliente_join()->first()->endereco;
            $info_fatura['valor_total'] = 0;

            $items = $this->repository_fatura_ordem_servico->where('id_fatura',$fatura->id);
            
            $ordens_servico = array();
            
            foreach ($items as $key => $value) {
                $ordens_servico[$key]['id'] = $value->id_ordem_servico;
                $ordens_servico[$key]['paciente'] = $this->repository_ordem_servico->where('id',$value->id_ordem_servico)->first()->paciente_join()->first()->nome;
                $ordens_servico[$key]['servico'] = $this->repository_ordem_servico->where('id'
                    ,$value->id_ordem_servico)->first()->servico_join()->first()->nome;
                $ordens_servico[$key]['quantidade'] = $this->repository_ordem_servico->where('id',$value->id_ordem_servico)->first()->quantidade;
                $ordens_servico[$key]['valor_unitario'] = $this->repository_ordem_servico->where('id',$value->id_ordem_servico)->first()->valor_unitario;
                $ordens_servico[$key]['valor_total'] = $this->repository_ordem_servico->where('id',$value->id_ordem_servico)->first()->valor_total;
                $info_fatura['valor_total'] = $info_fatura['valor_total']+$this->repository_ordem_servico->where('id',$value->id_ordem_servico)->first()->valor_total;
            }


            $pdf = PDF::loadView('fatura.pdf', ['info_fatura'=>$info_fatura,'ordens_servico'=>$ordens_servico])->setPaper('a4', 'landscape')->setWarnings(false);

            return $pdf->download('fatura'.$info_fatura['referencia'].$info_fatura['nome_cliente'].'.pdf');

        } catch (Exception $e) {
            $request->session()->flash('message',['title'=>'Erro','msg'=>'Erro ao realizar download do pdf. '.$resultado,'color'=>'error']);
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

        $ordem_servico = $this->repository_ordem_servico->where(DB::raw("to_char(created_at, 'MM/YYYY')"),$data['referencia'])->where('id_cliente',$data['id_cliente'])->where('id_situacao', 2)->where('id_grupo_kanban',4);


        unset($data['gerar_pdf']);
        unset($data['ano_referencia']);
        unset($data['mes_referencia']);

        $id_fatura = $this->repository->addWithId($data);

        foreach ($ordem_servico as $key => $value) {
            
            $this->repository_fatura_ordem_servico->add(['id_fatura' => $id_fatura, 'id_ordem_servico' => $value->id]);    
        }

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

