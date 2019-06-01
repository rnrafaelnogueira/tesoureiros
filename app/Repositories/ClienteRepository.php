<?php

namespace App\Repositories;

use App\Models\Cliente;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class ClienteRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Cliente $model
    )
    {
        $this->model = $model;
    }

}