<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\Paciente;
use App\Models\Servico;
use App\Models\Situacao;
use App\Models\GrupoKanban;

class OrdemServicoForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
            ->add('id_cliente', 'entity',[
                'class' => Cliente::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o cliente',
                'label' => 'Cliente',
                'rules' => 'nullable|exists:cliente,id'
            ])
            ->add('id_paciente', 'entity',[
                'class' => Paciente::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o paciente',
                'label' => 'Paciente',
                'rules' => 'nullable|exists:paciente,id'
            ])
             ->add('id_servico', 'entity',[
                'class' => Servico::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o serviço',
                'label' => 'Serviço',
                'rules' => 'nullable|exists:servico,id'
            ])
            ->add('id_situacao', 'entity',[
                'class' => Situacao::class,
                'property' => 'nome',
                'empty_value' => 'Selecione a situação',
                'label' => 'Situação',
                'rules' => 'nullable|exists:servico,id'
            ])
            ->add('id_grupo_kanban', 'entity',[
                'class' => GrupoKanban::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o Grupo kanban',
                'label' => 'Grupo kanban',
                'rules' => 'nullable|exists:grupos_kanban,id'
            ])
            ->add('data_previsao_entrega', 'datetime-local', [
                'label' => 'Data Previsão de Entrega'
            ])
            ->add('hora_previsao_entrega', 'text', [
                'label' => 'Hora Previsão Entrega'
            ]) 
            ->add('cor', 'text', [
                'label' => 'Cor'
            ])
            ->add('quantidade', 'text', [
                'label' => 'Quantidade'
            ])
            ->add('gerar_excel', 'hidden', [
                'label' => 'Gerar Excel'
            ]);
    }
}