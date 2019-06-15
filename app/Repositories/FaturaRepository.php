<?php

namespace App\Repositories;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Fatura;


class FaturaRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct( Fatura $model )
    {
        $this->model = $model;
    }
}