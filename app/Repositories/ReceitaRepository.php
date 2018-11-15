<?php

namespace App\Repositories;

use App\Models\Receita;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class ReceitaRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Receita $model
    )
    {
        $this->model = $model;
    }

}