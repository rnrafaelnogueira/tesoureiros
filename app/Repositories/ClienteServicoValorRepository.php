<?php

namespace App\Repositories;

use App\Models\ClienteServicoValor;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class ClienteServicoValorRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        ClienteServicoValor $model
    )
    {
        $this->model = $model;
    }

}