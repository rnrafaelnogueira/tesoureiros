<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Categoria;
use App\User;

class DespesaForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
          ->add('nome', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('id_user', 'entity',[
                'class' => User::class,
                'property' => 'name',
                'empty_value' => 'Selecione o membro',
                'label' => 'Membro',
                'rules' => 'nullable|exists:users,id'
            ])
            ->add('id_categoria', 'entity',[
                'class' => Categoria::class,
                'property' => 'nome',
                'empty_value' => 'Selecione a categoria',
                'label' => 'Categoria',
                'rules' => 'nullable|exists:categoria,id'
            ])->add('valor_fixo', 'text', [
                'label' => 'Valor',
                'rules' => 'required|max:255'
            ])->add('data_recibo', 'text', [
                'label' => 'Data Recibo',
                'rules' => 'required|max:255'
            ]);;
    }
}