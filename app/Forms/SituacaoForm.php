<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Situacao;

class SituacaoForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
            ->add('nome', 'text', [
                'label' => 'Nome'
            ]);
    }
}