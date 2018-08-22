<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\TipoReceita;
use App\Models\Mes;
use App\User;

class ReceitaForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
            ->add('id_user', 'entity',[
                'class' => User::class,
                'property' => 'name',
                'empty_value' => 'Selecione o membro',
                'label' => 'Membro',
                'rules' => 'nullable|exists:user,id'
            ])
            ->add('valor', 'text', [
                'label' => 'Valor',
                'rules' => 'required|max:255'
            ])
            ->add('tipo_receita', 'entity',[
                'class' => TipoReceita::class,
                'property' => 'descricao',
                'empty_value' => 'Selecione o tipo de receita',
                'label' => 'Tipo Receita',
                'rules' => 'nullable|exists:tipo_receita,id'
            ])
            ->add('mes', 'entity',[
                'class' => Mes::class,
                'property' => 'descricao',
                'empty_value' => 'Selecione o mês',
                'label' => 'Mês',
                'rules' => 'nullable|exists:mes,id'
            ]);;
    }
}