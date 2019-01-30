<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Despesa;
use App\Models\Mes;
use App\User;

class PagamentoForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
            ->add('valor', 'text', [
                'label' => 'Valor',
                'rules' => 'required|max:255'
            ])
            ->add('id_despesa', 'entity',[
                'class' => Despesa::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o tipo de receita',
                'label' => 'Tipo Receita',
                'rules' => 'nullable|exists:despesa,id'
            ])
            ->add('mes', 'entity',[
                'class' => Mes::class,
                'property' => 'descricao',
                'empty_value' => 'Selecione o mês',
                'label' => 'Mês',
                'rules' => 'nullable|exists:mes,id'
            ])
            ->add('flag_download', 'text', [
                'label' => 'Download Excel'
            ]);
    }
}