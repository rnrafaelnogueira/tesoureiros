<?php

namespace App\Repositories;

use App\Models\OrdemServico;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class OrdemServicoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        OrdemServico $model
    )
    {
        $this->model = $model;
    }

}