<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 17/08/2018
 * Time: 12:52
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => "required|max:255|unique:users,email,$id"
            ])
            ->add('cpf', 'text', [
                'label' => 'Cpf',
                'rules' => "required|max:255|unique:users,cpf,$id"
            ])
            ->add('password', 'text', [
                'label' => 'Senha',
                'rules' => "required"
            ])
            ->add('file', 'file', [
                'label' => 'Importar XLS'
            ]);
    }
}