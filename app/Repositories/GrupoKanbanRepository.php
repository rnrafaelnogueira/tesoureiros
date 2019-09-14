<?php

namespace App\Repositories;

use App\Models\GrupoKanban;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class GrupoKanbanRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        GrupoKanban $model
    )
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->all();
    }   
}