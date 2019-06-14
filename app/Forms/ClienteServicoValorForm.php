<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\ClienteServicoValor;
use App\Models\Cliente;
use App\Models\Servico;

class ClienteServicoValorForm extends Form
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
             ->add('id_servico', 'entity',[
                'class' => Servico::class,
                'property' => 'nome',
                'empty_value' => 'Selecione o servico',
                'label' => 'Serviço',
                'rules' => 'nullable|exists:servico,id'
            ])
             ->add('valor', 'text', [
                'label' => 'Valor'
            ]);
    }
}