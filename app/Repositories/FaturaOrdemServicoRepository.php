<?php

namespace App\Repositories;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;
use App\Models\FaturaOrdemServico;


class FaturaOrdemServicoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct( FaturaOrdemServico $model )
    {
        $this->model = $model;
    }
}