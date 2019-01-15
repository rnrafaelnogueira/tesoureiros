<?php

namespace App\Repositories;

use App\Models\Categoria;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class CategoriaRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Categoria $model
    )
    {
        $this->model = $model;
    }

}