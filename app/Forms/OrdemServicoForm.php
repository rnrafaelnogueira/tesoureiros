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

        $this->add('id_cliente', 'entity',[
                'class' => Cliente::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o cliente',
                'label' => 'Cliente',
                'rules' => 'nullable|exists:cliente,id'
            ])->add('nome_paciente', 'text', [
                'label' => 'Paciente'
            ])->add('obs_paciente', 'text', [
                'label' => 'Observação'
            ])->add('id_servico', 'entity',[
                'class' => Servico::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o serviço',
                'label' => 'Serviço',
                'rules' => 'nullable|exists:servico,id'
            ])->add('id_situacao', 'entity',[
                'class' => Situacao::class,
                'property' => 'nome',
                'empty_value' => 'Selecione a situação',
                'label' => 'Situação',
                'rules' => 'nullable|exists:situacao,id'
            ])->add('id_grupo_kanban', 'entity',[
                'class' => GrupoKanban::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o Grupo kanban',
                'label' => 'Grupo kanban',
                'rules' => 'nullable|exists:grupos_kanban,id'
            ])->add('data_previsao_entrega', 'datetime-local', [
                'label' => 'Data Previsão de Entrega'
            ])->add('hora_previsao_entrega', 'text', [
                'label' => 'Hora Previsão Entrega'
            ])->add('cor', 'text', [
                'label' => 'Cor'
            ])->add('quantidade', 'text', [
                'label' => 'Quantidade'
            ])->add('valor_padrao','select', [
                'choices' => ['S' => 'Sim', 'N' => 'Não'],
                'label' => 'Valor Padrão',
                'selected' => 'S',
            ])->add('valor_unitario', 'text', [
                'label' => 'Valor Unitário'
            ])->add('gerar_excel', 'select', [
                'choices' => ['S' => 'Sim', 'N' => 'Não'],
                'label' => 'Gerar Excel',
                'selected' => 'N',
            ]);
    }
}