<?php

namespace App\Repositories;

use App\Models\Situacao;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class SituacaoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Situacao $model
    )
    {
        $this->model = $model;
    }

}