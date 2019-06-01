<?php

namespace App\Repositories;

use App\Models\Paciente;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class PacienteRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Paciente $model
    )
    {
        $this->model = $model;
    }

}