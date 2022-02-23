<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Cliente;

class FaturaForm extends Form
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
            ])->add('mes_referencia','select', [
                'choices' => ['01' => 'Janeiro',
                                '02' => 'Fevereiro',
                                '03' => 'Março',
                                '04' => 'Abril',
                                '05' => 'Maio',
                                '06' => 'Junho',
                                '07' => 'Julho',
                                '08' => 'Agosto',
                                '09' => 'Setembro',
                                '10' => 'Outubro',
                                '11' => 'Novembro',
                                '12' => 'Dezembro'],
                'label' => 'Mês Referência',
                'selected' => 'N',
            ])->add('ano_referencia','select', [
                'choices' => ['2019' => '2019'
                            , '2020' => '2020'
                            , '2021' => '2021'
                            , '2022' => '2022'
                            , '2023' => '2023'
                            , '2024' => '2024'
                            , '2025' => '2025'],
                'label' => 'Ano Referência',
                'selected' => 'N',
            ])->add('enviada','select', [
                'choices' => ['S' => 'Sim', 'N' => 'Não'],
                'label' => 'Enviada',
                'selected' => 'N',
            ])->add('baixada', 'select', [
                'choices' => ['S' => 'Sim', 'N' => 'Não'],
                'label' => 'Baixada',
                'selected' => 'N',
            ])->add('gerar_pdf', 'select', [
                'choices' => ['S' => 'Sim', 'N' => 'Não'],
                'label' => 'Gerar PDF',
                'selected' => 'N',
            ]);
    }
}