<?php

namespace App\Repositories;

use App\Models\Despesa;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class DespesaRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Despesa $model
    )
    {
        $this->model = $model;
    }

}