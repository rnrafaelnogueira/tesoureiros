<?php

namespace App\Repositories;

use App\Models\Servico;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class ServicoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Servico $model
    )
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->all();
    }   
}