<?php

namespace App\Repositories;

use App\Receita;
use Illuminate\Support\Facades\DB;



class ReceitaRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        User $model
    )
    {
        $this->model = $model;
    }
}